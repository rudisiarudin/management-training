<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingSchedule;
use Illuminate\Http\Request;

class TrainingScheduleController extends Controller
{
    public function index() {
        $trainingSchedule = TrainingSchedule::get();

        return view('admin-dashboard.schedule-training.index', ['trainingSchedule' => $trainingSchedule]);
    }

    public function create() {
        $trainings = Training::get();

        return view('admin-dashboard.schedule-training.create', ['trainings' => $trainings]);
    }

    public function save(Request $request) {
        $trainingSchedule = $request->validate([
            'training_id' => 'required',
            'schedule_date' => 'required',
            'location' => 'required|min:1',
            'estimate_budget' => 'required|numeric',
            'pic' => '',
            'minimum_participant' => '',
            'permission_document' => ''
        ]);

        $file = $request->file('permission_document');
        $filePath = 'img/permissions/' . Training::getTrainingNameSlugById($request->training_id) . '/' . $request->schedule_date;
        $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();

        $file->move($filePath, $fileName);
        $trainingSchedule['permission_document'] = $filePath . '/' . $fileName;

        TrainingSchedule::create($trainingSchedule);

        return redirect()->route('training-schedule-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new training schedule.'
        ]);
    }

    public function edit($id) {
        $trainingSchedule = TrainingSchedule::find($id);
        $trainings = Training::get();

        return view('admin-dashboard.schedule-training.edit', ['trainingSchedule' => $trainingSchedule, 'trainings' => $trainings]);
    }

    public function update(Request $request, $id) {
        $trainingSchedule = $request->validate([
            'training_id' => 'required',
            'schedule_date' => 'required',
            'location' => 'required|min:1',
            'estimate_budget' => 'required|numeric',
            'pic' => '',
            'minimum_participant' => ''
        ]);

        $beforeUpdate = TrainingSchedule::find($id);
        $trainingSchedule['permission_document'] = $beforeUpdate->permission_document;

        if ($request->hasFile('permission_document') && $request->file('permission_document')->isValid()) {
            $file = $request->file('permission_document');
            $filePath = 'img/permissions/' . Training::getTrainingNameSlugById($request->training_id) . '/' . $request->schedule_date;
            $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();

            $file->move($filePath, $fileName);
            $trainingSchedule['permission_document'] = $filePath . '/' . $fileName;;
        }

        $beforeUpdate->update($trainingSchedule);

        return redirect()->route('training-schedule-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new training schedule.'
        ]);
    }

    public function destroy($id) {
        TrainingSchedule::find($id)->delete();

        return redirect()->route('training-schedule-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete training schedule data.'
        ]);
    }
}
