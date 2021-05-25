<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Models\Participant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ParticipantController extends Controller
{
    public function index() {
        $participants = Participant::get();

        return view('admin-dashboard.participant.index', ['participants' => $participants]);
    }

    public function create() {
        return view('admin-dashboard.participant.create');
    }

    public function create_bulk() {
        return view('admin-dashboard.participant.create-bulk');
    }

    public function save(Request $request) {
        $participant = $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        $participant['company_id'] = 1;
        $participant['training_id'] = 1;
        $participant['status'] = 1;

        Participant::create($participant);

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
}
