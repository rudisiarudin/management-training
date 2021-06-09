<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index() {
        $registrations = Registration::get();

        return view('admin-dashboard.registration.index', ['registrations' => $registrations]);
    }

    public function create() {
        return view('admin-dashboard.registration.create');
    }
}
