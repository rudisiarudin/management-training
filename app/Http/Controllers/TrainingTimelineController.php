<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\TrainingTimeline;
use Illuminate\Http\Request;

class TrainingTimelineController extends Controller
{
    public function index() {
        $trainingTimelines = TrainingTimeline::groupBy('training_schedule_id')->get();

        return view('admin-dashboard.training-timeline.index', compact('trainingTimelines'));
    }

    public function show($id) {
        $trainingTimelines = TrainingTimeline::where('training_schedule_id', $id)->paginate(10);
        $trainers = Trainer::get();

        return view('admin-dashboard.training-timeline.detail-list', compact('trainingTimelines', 'trainers'));
    }

    public function update(Request $request) {
        $id = $request->input('id');
        $trainerId = $request->input('trainer_id');
        $trainingTimeline = TrainingTimeline::find($id);

        $trainingTimeline->update([
            'trainer_id' => $trainerId
        ]);

        return redirect()->route('training-timeline-show', ['id' => $trainingTimeline->trainingSchedule->id])->with([
            'status' => 'success',
            'message' => 'Successfully update training schedule.'
        ]);
    }
}
