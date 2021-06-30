<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Registration;
use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Models\TrainingTimeline;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontAppController extends Controller
{
    public function index() {
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        $registrations = Registration::where('participant_id', $participant->id)->get();
        $trainingSchedulesId = $registrations->map(function ($item) {
            return $item->training_schedule_id;
        });
        $trainingSchedule = TrainingSchedule::whereIn('id', $trainingSchedulesId)
            ->where('schedule_date', '>=', Carbon::now()->format('Y-m-d'))
            ->with('training', 'trainingTimelines')
            ->first();
        $trainingTimelines = TrainingTimeline::where('training_schedule_id', $trainingSchedule->id)->with('trainingSchedule')->get();
        $trainingToday = $trainingTimelines->where('schedule_date', '=', Carbon::now()->format('Y-m-d 00:00:00'))->first();
        $trainingTomorrow = $trainingTimelines->where('schedule_date', '=', Carbon::now()->addDay(1)->format('Y-m-d 00:00:00'))->first();

        return view('front-app.index', compact(
            'participant',
            'registrations',
            'trainingSchedule',
            'trainingTimelines',
            'trainingToday',
            'trainingTomorrow'
        ));
    }

    public function trainingList() {
        $trainingSchedule = TrainingSchedule::where('schedule_date', '>', Carbon::now()->format('Y-m-d'))->get();

        return view('front-app.training-list', compact('trainingSchedule'));
    }

    public function register($id) {
        $trainingSchedule = TrainingSchedule::find($id);

        return view('front-app.sreg', compact('trainingSchedule'));
    }
}
