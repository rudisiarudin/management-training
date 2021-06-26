<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantImport implements ToModel
{
    protected $trainingId;

    public function __construct($training_id)
    {
        $this->trainingId = $training_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Participant([
            'name' => $row[0],
            'address' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'training_id' => $this->trainingId
        ]);
    }
}
