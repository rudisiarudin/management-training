<?php

namespace App\Services;

use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\UploadedFile;

class ParticipantService
{
    const PATH_FILE_PERSYARATAN = 'document/persyaratan-peserta/';

    public function saveParticipant($request) {
        $ktp = $ijazah = $suratKeterangan = '';
        $createdParticipant = Participant::create($request->except('_token'));

        if ($request->hasFile('ktp')) {
            $ktp = $this->saveFileToStorage(
                $request->file('ktp'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($createdParticipant) . '/ktp/'
            );
        }

        if ($request->hasFile('ijazah')) {
            $ijazah = $this->saveFileToStorage(
                $request->file('ijazah'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($createdParticipant) . '/ijazah/'
            );
        }

        if ($request->hasFile('surat_pengantar')) {
            $suratKeterangan = $this->saveFileToStorage(
                $request->file('surat_pengantar'),
                self::PATH_FILE_PERSYARATAN . $this->getParticipantFilePath($createdParticipant) . '/surat_pengantar/'
            );
        }

        $createdParticipant->update([
            'ktp' => $ktp,
            'ijazah' => $ijazah,
            'surat_pengantar' => $suratKeterangan,
        ]);

        return $createdParticipant;
    }

    public function updateFileParticipant($request, $id) {
        $participant = Participant::find($id);

        $ktp = $participant->ktp;
        $ijazah = $participant->ijazah;
        $suratPengantar = $participant->surat_pengantar;

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

        $params = $request->except('_token');
        $params['ktp'] = $ktp;
        $params['ijazah'] = $ijazah;
        $params['surat_pengantar'] = $suratPengantar;

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
