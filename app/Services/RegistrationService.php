<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationService
{
    public function __construct() {

    }

    public function updateProofTransfer(Request $request, $id) {
        $registration = Registration::find($id);
        $params = [];

        if ($request->hasFile('proof_transfer')) {
            $file = $request->file('proof_transfer');
            $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();
            $file->move('img/proof_transfer/', $fileName);

            $params['proof_transfer'] =  'img/proof_transfer/' . $fileName;
        }

        $registration->update($params);
    }
}
