<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id')->withDefault();
    }

    public function trainingSchedule() {
        return $this->belongsTo(TrainingSchedule::class, 'training_id')->withDefault();
    }

    public function registrations() {
        return $this->hasMany(Registration::class, 'participant_id');
    }
}
