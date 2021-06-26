<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Training extends Model
{
    use HasFactory;

    protected $guarded = [];

    static function getTrainingNameSlugById($id) {
        return Str::kebab(Training::find($id)->name);
    }

    public function training_schedules() {
        return $this->hasMany(TrainingSchedule::class);
    }
}
