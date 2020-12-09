<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember =  $request->input('remember');

        if (Auth::attempt(['email' => $input['email'], 'password' =>  $input['password']], $remember)) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        } else if (Auth::attempt(['name' => $input['email'], 'password' =>  $input['password']], $remember)) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('message', 'Wrong credentials.');
        }
    }
}
