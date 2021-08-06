<?php

namespace App\Imports;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;

class ParticipantImport implements ToModel, WithEvents
{
    use RegistersEventListeners;

    protected $trainingId;
    protected $participants;

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
        $participant = new Participant([
            'name' => $row[0],
            'address' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'raw_company' => $row[4],
            'training_id' => $this->trainingId
        ]);

        $this->participants[] = $participant;

        return $participant;
    }

    public static function afterImport(AfterImport $afterImport) {
        $participants = $afterImport->getConcernable()->participants;

        foreach ($participants as $key => $item) {
            $user = User::create([
                'name' => $item->name,
                'email' => $item->email,
                'password' => Hash::make('password'),
                'role_id' => User::ROLE_ID_USER
            ]);

            $item->update(['user_id' => $user->id]);
        }
    }
}
