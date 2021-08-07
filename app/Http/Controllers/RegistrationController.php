<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Registration;
use App\Models\TrainingSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index() {
        $groupFilter = \request()->get('groupFilter');
        $query = Registration::query();
        $query->when($groupFilter, function($q) use($groupFilter) {
            return $q->where('training_schedule_id', $groupFilter);
        });
        $registrations = $query->get();
        $trainingSchedule = TrainingSchedule::get();

        return view('admin-dashboard.registration.index', ['registrations' => $registrations, 'trainingSchedule' => $trainingSchedule]);
    }

    public function create() {
        $trainingSchedules = TrainingSchedule::get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->training->name . ' - ' . Carbon::parse($item->schedule_date)->format('d/m/Y')
            ];
        });

        $participants = Participant::get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name
            ];
        });

        return view('admin-dashboard.registration.create', compact('trainingSchedules', 'participants'));
    }

    public function save(Request $request) {
        $params = $request->validate([
            'name' => 'required',
            'training_schedule_id' => 'required',
            'phone' => 'required',
            'participant_id' => 'required',
            'email' => 'required'
        ]);

        Registration::create($params);

        return redirect()->route('registration-index')->with([
            'status' => 'success',
            'message' => 'Successfully create registration data.'
        ]);
    }

    public function edit($id) {
        $registration = Registration::find($id);
        $trainingSchedules = TrainingSchedule::get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->training->name . ' - ' . Carbon::parse($item->schedule_date)->format('d/m/Y')
            ];
        });

        return view('admin-dashboard.registration.edit', compact('registration', 'trainingSchedules'));
    }

    public function update(Request $request, $id) {
        $params = $request->validate([
            'name' => 'required',
            'training_schedule_id' => 'required',
            'phone' => 'required',
            'is_paid' => '',
            'certificate_progress' => '',
            'proof_transfer' => ''
        ]);

        if ($request->hasFile('proof_transfer')) {
            $file = $request->file('proof_transfer');
            $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();
            $pathName = 'document/proof-transfer/';
            $file->move($pathName, $fileName);
            $params['proof_transfer'] = $pathName . $fileName;
        }

        $registration = Registration::find($id);
        $registration->update($params);

        return redirect()->route('registration-index')->with([
            'status' => 'success',
            'message' => 'Successfully update registration data.'
        ]);
    }

    public function destroy($id) {
        $registration = Registration::find($id);
        $registration->delete();

        return redirect()->route('registration-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete registration data.'
        ]);
    }
}
