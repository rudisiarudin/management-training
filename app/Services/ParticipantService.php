<?php

namespace App\Services;

use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\UploadedFile;

class ParticipantService
{
    const PATH_FILE_PERSYARATAN = 'document/persyaratan-peserta/';

    public function saveParticipant($request) {
        $createdParticipant = Participant::create($request->except('_token'));

        if ($request->hasFile('ktp') || $request->hasFile('ijazah') || $request->hasFile('surat_pengantar')) {
            $ktp = $this->saveFileToStorage(
                $request->file('ktp'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($createdParticipant) . '/ktp/'
            );

            $ijazah = $this->saveFileToStorage(
                $request->file('ktp'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($createdParticipant) . '/ijazah/'
            );

            $suratKeterangan = $this->saveFileToStorage(
                $request->file('surat_keterangan'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($createdParticipant) . '/surat_keterangan/'
            );

            $createdParticipant->update();
        }

        if ($request->training_id) {
            Registration::create([
                'training_schedule_id' => $request->training_id,
                'participant_id' => $createdParticipant->id,
                'name' => $createdParticipant->name,
                'email' => $createdParticipant->email,
                'phone' => $createdParticipant->phone,
            ]);
        }
    }

    public function saveFileToStorage(UploadedFile $file, $pathName) {
        $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();
        $file->move($pathName, $fileName);

        return $pathName . $fileName;
    }

    public function getParticipantFilePath($participant) {
        return $participant->name . ' - ' . $participant->id;
    }
}
