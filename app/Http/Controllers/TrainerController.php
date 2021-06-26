<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index() {
        $trainers = Trainer::get();

        return view('admin-dashboard.trainer.index', compact('trainers'));
    }

    public function create() {
        $trainings = Training::get();

        return view('admin-dashboard.trainer.create', compact('trainings'));
    }

    public function save(Request $request) {
        $trainer = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'organization' => '',
            'company' => '',
            'lecture_name' => 'required',
            'training_id' => '',
        ]);

        Trainer::create($trainer);

        return redirect()->route('trainer-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new trainer data.'
        ]);
    }

    public function edit($id) {
        $trainer = Trainer::find($id);
        $trainings = Training::get();

        return view('admin-dashboard.trainer.edit', compact('trainer', 'trainings'));
    }

    public function update(Request $request, $id) {
        $params = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'organization' => '',
            'company' => '',
            'lecture_name' => 'required',
            'training_id' => '',
        ]);

        $trainer = Trainer::find($id);
        $trainer->update($params);

        return redirect()->route('trainer-index')->with([
            'status' => 'success',
            'message' => 'Successfully update trainer data.'
        ]);
    }

    public function destroy($id) {
        $trainer = Trainer::find($id);
        $trainer->delete();

        return redirect()->route('trainer-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete trainer data.'
        ]);
    }
}
