<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index() {
        $trainings = Training::get();

        return view('admin-dashboard.training.index', compact('trainings'));
    }

    public function create() {
        return view('admin-dashboard.training.create');
    }

    public function save(Request $request) {
        $request->validate([
            'name' => 'required',
            'training_type' => 'required',
            'duration' => 'required',
        ]);

        Training::create($request->except('_token'));

        return redirect()->route('training-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new training data.'
        ]);
    }

    public function edit($id) {
        $training = Training::find($id);

        return view('admin-dashboard.training.edit', compact('training'));
    }

    public function update(Request $request, $id) {
        $training = Training::find($id);

        $request->validate([
            'name' => 'required',
            'training_type' => 'required',
            'duration' => 'required',
        ]);

        $training->update($request->except('_token'));

        return redirect()->route('training-index')->with([
            'status' => 'success',
            'message' => 'Successfully update training data.'
        ]);
    }

    public function destroy($id) {
        $training = Training::find($id);
        $training->delete();

        return redirect()->route('training-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete training data.'
        ]);
    }
}
