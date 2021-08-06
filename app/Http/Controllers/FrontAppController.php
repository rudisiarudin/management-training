<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Registration;
use App\Models\Training;
use App\Models\TrainingSchedule;
use App\Models\TrainingTimeline;
use App\Models\User;
use App\Services\ParticipantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FrontAppController extends Controller
{
    protected $participantService;

    public function __construct(
        ParticipantService $participantService
    ) {
        $this->middleware('auth');
        $this->participantService = $participantService;

       if (Gate::allows('isUser')) {
           return abort(403, 'Only for registered participant.');
       }
    }

    public function index() {
        $trainingTimelines = $trainingToday = $trainingTomorrow = [];
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        $registrations = Registration::where('participant_id', $participant->id)->get();
        $trainingSchedulesId = $registrations->map(function ($item) {
            return $item->training_schedule_id;
        });
        $trainingSchedule = TrainingSchedule::whereIn('id', $trainingSchedulesId)
            ->where('schedule_date', '>=', Carbon::now()->format('Y-m-d'))
            ->with('training', 'trainingTimelines')
            ->first();

        if (filled($trainingSchedule)) {
            $trainingTimelines = TrainingTimeline::where('training_schedule_id', $trainingSchedule->id)->with('trainingSchedule')->get();
            $trainingToday = $trainingTimelines->where('schedule_date', '=', Carbon::now()->format('Y-m-d 00:00:00'))->first();
            $trainingTomorrow = $trainingTimelines->where('schedule_date', '=', Carbon::now()->addDay(1)->format('Y-m-d 00:00:00'))->first();
        }

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

        return view('front-app.register', compact('trainingSchedule'));
    }

    public function profile() {
        $user = User::find(auth()->user()->id);

        return view('front-app.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->only('name'));

        $this->participantService->updateFileParticipant($request, $user->participant->id);


        return redirect()->route('front-app-profile')->with([
            'status' => 'success',
            'message' => 'Sukses mengubah data profil.'
        ]);
    }

    public function saveRegistration(Request $request, $id) {
        $request->validate([
            'training_schedule_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $params = $request->except('_token');
        $participant = auth()->user()->participant;
        $isExist = Registration::where([
            'training_schedule_id' => $id,
            'participant_id' => $participant->id
        ])->get();
        $params['training_schedule_id'] = $id;
        $params['participant_id'] = $participant->id;

//        dd($params);
//        dd($isExist);

        if ($isExist->count()) {
            return redirect()->route('front-app-register', compact('id'))->with([
                'status' => 'error',
                'message' => 'Anda sudah mendaftar di pelatihan ini.'
            ]);
        }

        Registration::create($params);

        return redirect()->route('front-app-home')->with([
            'status' => 'success',
            'message' => 'Pendaftaran berhasil dikirim, mohon menunggu konfirmasi dari admin kami.'
        ]);
    }
}
