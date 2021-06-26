<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingTimeline extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function trainingSchedule() {
        return $this->belongsTo(TrainingSchedule::class);
    }

    public function trainer() {
        return $this->belongsTo(Trainer::class);
    }
}
