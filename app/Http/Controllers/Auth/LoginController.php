<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = 'admin-dashboard/training-schedule';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin-dashboard.auth.login');
    }

    public function loggedOut(Request $request)
    {
        return redirect()->to('login');
    }

    public function redirectTo() {
        $role = \auth()->user()->role_id;

        if ($role == User::ROLE_ID_ADMIN) {
            return '/admin-dashboard';
        } elseif ($role == User::ROLE_ID_USER) {
            return '/front-app';
        } else {
            return '/admin-dashboard';
        }
    }
}
