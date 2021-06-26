<?php

namespace App\Services;

use App\Models\Trainer;
use App\Models\TrainingSchedule;
use App\Models\TrainingTimeline;
use Carbon\Carbon;

class TrainingScheduleService
{
    public function generateTrainingTimeline(TrainingSchedule $trainingSchedule) {
        $trainingType = $trainingSchedule->training->id;
        $trainer = Trainer::where('training_id', $trainingType)->get();
        $duration = $trainingSchedule->training->duration;
        $i = 0;
        $timelineData = [];

        while ($i < $duration) {
            $scheduleDate = Carbon::parse($trainingSchedule->schedule_date)->add($i, 'day');
            $timelineData['training_schedule_id'] = $trainingSchedule->id;
            $timelineData['schedule_date'] = $scheduleDate;

            if (isset($trainer[$i])) {
                $timelineData['trainer_id'] = $trainer[$i]->id;
            } else {
                $timelineData['trainer_id'] = NULL;
            }

            TrainingTimeline::create($timelineData);

            $i++;
        }
    }
}
