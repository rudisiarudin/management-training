<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Models\Company;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\TrainingSchedule;
use App\Services\ParticipantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantController extends Controller
{
    protected $participantService;

    public function __construct(
        ParticipantService $participantService
    ) {
        $this->participantService = $participantService;
    }

    public function index() {
        $participants = Participant::get();

        return view('admin-dashboard.participant.index', ['participants' => $participants]);
    }

    public function create() {
        $companies = Company::get()->map(function ($item) {
           return ['id' => $item->id, 'name' => $item->name];
        });

        $trainingSchedules = TrainingSchedule::get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->training->name . ' - ' . Carbon::parse($item->schedule_date)->format('d/m/Y')
            ];
        });

        return view('admin-dashboard.participant.create', compact('companies', 'trainingSchedules'));
    }

    public function create_bulk() {
        return view('admin-dashboard.participant.create-bulk');
    }

    public function save(Request $request) {
        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'company_id' => 'required',
            'training_id' => '',
            'ktp' => '',
            'ijazah' => '',
            'surat_pengantar' => '',
        ]);

        $this->participantService->saveParticipant($request);

        return redirect()->route('participant-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new participant.'
        ]);
    }

    public function save_bulk(Request $request) {
        $request->validate([
            'participant_data' => 'required'
        ]);

        $file = $request->file('participant_data');
        $filePath = 'document/excel/participant_bulk/';
        $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();

        $file->move($filePath, $fileName);

        \Maatwebsite\Excel\Facades\Excel::import(new ParticipantImport(), public_path($filePath . $fileName));

        return redirect()->route('participant-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new participant.'
        ]);
    }

    public function destroy($id) {
        $participant = Participant::find($id);
        $participant->delete();

        return redirect()->route('participant-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete participant.'
        ]);
    }

    public function edit($id) {
        $participant = Participant::find($id);

        return view('admin-dashboard.participant.edit', ['participant' => $participant]);
    }

    public function getTemplate() {
        return Excel::store();
    }
}
