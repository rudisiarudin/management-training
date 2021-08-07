<?php

namespace App\Services;

use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\UploadedFile;

class ParticipantService
{
    const PATH_FILE_PERSYARATAN = 'document/persyaratan-peserta/';
    const PATH_PROFILE_IMAGE = 'img/profile/';

    public function saveParticipant($params) {
        $createdParticipant = Participant::create($params);

        return $createdParticipant;
    }

    public function updateFileParticipant($request, $id) {
        $participant = Participant::find($id);

        $ktp = $participant->ktp;
        $ijazah = $participant->ijazah;
        $suratPengantar = $participant->surat_pengantar;
        $profileImage = $participant->profile_image;

        if ($request->hasFile('ktp')) {
            $ktp = $this->saveFileToStorage(
                $request->file('ktp'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($participant) . '/ktp/'
            );
        }

        if ($request->hasFile('ijazah')) {
            $ijazah = $this->saveFileToStorage(
                $request->file('ijazah'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($participant) . '/ijazah/'
            );
        }

        if ($request->hasFile('surat_pengantar')) {
            $suratPengantar = $this->saveFileToStorage(
                $request->file('surat_pengantar'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($participant) . '/surat_pengantar/'
            );
        }

        if ($request->hasFile('profile_image')) {
            $profileImage = $this->saveFileToStorage(
                $request->file('profile_image'),
                self::PATH_PROFILE_IMAGE
            );
        }

        $params = $request->except('_token', 'proof_transfer');
        $params['ktp'] = $ktp;
        $params['ijazah'] = $ijazah;
        $params['surat_pengantar'] = $suratPengantar;
        $params['profile_image'] = $profileImage;

        $participant->update($params);
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
