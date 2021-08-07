<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\TrainingSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() {
        $trainingSchedule = TrainingSchedule::where('schedule_date', '>=', Carbon::now()->format('Y-m-d'))->get();
        $participants = Participant::get();
        $unpaidRegistrations = Registration::where('is_paid', Registration::UNPAID)->with('trainingSchedule')->get();
        $companiesCount = Company::get()->count();

        return \view('admin-dashboard.index', compact('trainingSchedule', 'participants', 'unpaidRegistrations', 'companiesCount'));
    }

    public function index() {
        $users = User::whereIn('role_id', [2, 3])->get();

        return view('admin-dashboard.admin.index', compact('users'));
    }

    public function create() {
        return view('admin-dashboard.admin.create');
    }

    public function save(Request $request) {
        $params = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users|string|email',
            'password' => 'required|min:8|confirmed'
        ]);
        $params['password'] = Hash::make($params['password']);
        $params['role_id'] = User::ROLE_ID_ADMIN;

        User::create($params);

        return redirect()->route('admin-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new admin account.'
        ]);
    }

    public function destroy($id) {
        User::find($id)->delete();

        return redirect()->route('admin-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete admin account.'
        ]);
    }

    public function edit($id) {
        $user = User::find($id);

        return view('admin-dashboard.admin.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string',
            'role_id' => '',
            'user_photo' => ''
        ]);
        $user = User::find($id);
        $profileImage = '';

        if ($request->hasFile('user_photo')) {
            $file = $request->file('user_photo');
            $fileName = md5($file->getFilename()) . '.' . $file->getClientOriginalExtension();
            $file->move('img/profile/', $fileName);

            $profileImage =  'img/profile/' . $fileName;
        }

        $params = $request->except('_token');
        $params['user_photo'] = $profileImage;

        $user->update($params);

        return redirect()->route('admin-index')->with([
            'status' => 'success',
            'message' => 'Successfully update admin account.'
        ]);
    }
}
