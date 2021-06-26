<?php

namespace App\Http\Controllers;

use App\Exports\TrainingScheduleExport;
use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Services\TrainingScheduleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Excel;

class TrainingScheduleController extends Controller
{
    protected $trainingScheduleService;

    public function __construct(
        TrainingScheduleService $trainingScheduleService
    ) {
        $this->trainingScheduleService = $trainingScheduleService;
    }

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

        $savedTrainingSchedule = TrainingSchedule::create($trainingSchedule);

        $this->trainingScheduleService->generateTrainingTimeline($savedTrainingSchedule);

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
            'status' => '',
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

    public function report($id) {
        $trainingSchedule = TrainingSchedule::find($id);

        return Excel::download(new TrainingScheduleExport($id), 'test-excel.xlsx');
    }

    public function generateBap($id) {
        $trainingSchedule = TrainingSchedule::find($id);
        $bapNumber = $trainingSchedule->id . '/TMI-BAP/K3/' . Carbon::now()->format('m-Y');
        $pdf = PDF::loadView('pdf-template.training-bap', compact('trainingSchedule', 'bapNumber'));

        return $pdf->stream('test.pdf');
    }

    public function generateAbsence($id) {
        $trainingSchedule = TrainingSchedule::find($id);
        $pdf = PDF::loadView('pdf-template.training-absence', compact('trainingSchedule'));

        return $pdf->stream('test.pdf');
    }

    public function generateRequirementDocument($id) {
        $trainingSchedule = TrainingSchedule::find($id);
        $pdf = PDF::loadView('pdf-template.requirement-training', compact('trainingSchedule'));

        return $pdf->stream('test.pdf');
    }
}
