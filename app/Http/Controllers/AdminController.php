<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return \view('admin-dashboard.index');
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
}
