<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSchedule extends Model
{
    use HasFactory;

    const STATUS_FINISHED = 3;

    protected $guarded = [];

    public function training() {
        return $this->belongsTo(Training::class)->withDefault();
    }

    public function registrations() {
        return $this->hasMany(Registration::class);
    }

    public function trainingTimelines() {
        return $this->hasMany(TrainingTimeline::class);
    }
}
