<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Models\Company;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\TrainingSchedule;
use App\Models\User;
use App\Services\ParticipantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $searchName = \request()->get('searchName');
        $sortData = \request()->get('sortData') ?: 'asc';
        $participants = Participant::where( function($q) use($searchName, $sortData) {
            if ($searchName) {
                $q->where('name', 'like', '%' . $searchName . '%');
            }
        })
        ->orderBy('id', $sortData)
        ->paginate(10);

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
        $trainingSchedules = TrainingSchedule::get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->training->name . ' - ' . Carbon::parse($item->schedule_date)->format('d/m/Y')
            ];
        });

        return view('admin-dashboard.participant.create-bulk', compact('trainingSchedules'));
    }

    public function save(Request $request) {
        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email|unique:participants',
            'phone' => 'required|numeric',
            'address' => 'required',
            'company_id' => 'required',
            'training_id' => '',
            'ktp' => '',
            'ijazah' => '',
            'surat_pengantar' => '',
        ]);

        $createdParticipant = $this->participantService->saveParticipant($request->except('_token'));
        $this->participantService->updateFileParticipant($request, $createdParticipant->id);

        if ($request->training_id) {
            Registration::create([
                'training_schedule_id' => $request->training_id,
                'participant_id' => $createdParticipant->id,
                'name' => $createdParticipant->name,
                'email' => $createdParticipant->email,
                'phone' => $createdParticipant->phone,
            ]);
        }

        $params = $request->only(['name', 'email',]);
        $params['password'] = Hash::make('password');
        $params['role_id'] = User::ROLE_ID_USER;
        $createdUser = User::create($params);

        $createdParticipant->update(['user_id' => $createdUser->id]);

        return redirect()->route('participant-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new participant.'
        ]);
    }

    public function save_bulk(Request $request) {
        $request->validate([
            'participant_data' => 'required',
            'training_id' => 'required'
        ]);
        $trainingId = $request->input('training_id');

        $file = $request->file('participant_data');
        $filePath = 'document/excel/participant_bulk/';
        $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();

        $file->move($filePath, $fileName);

        Excel::import(new ParticipantImport($trainingId), public_path($filePath . $fileName));

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
        $companies = Company::get()->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name];
        });

        return view('admin-dashboard.participant.edit', compact('participant', 'companies'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:45',
            'phone' => 'required|numeric',
            'address' => 'required',
            'ktp' => '',
            'ijazah' => '',
            'surat_pengantar' => '',
        ]);

        $this->participantService->updateFileParticipant($request, $id);

        return redirect()->route('participant-index')->with([
            'status' => 'success',
            'message' => 'Successfully update participant.'
        ]);
    }

    public function getTemplate() {
        return Excel::store();
    }
}
