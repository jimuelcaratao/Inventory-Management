<?php

namespace App\Http\Controllers;

use App\Models\UserSecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserSecurityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = DB::table('users')
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->join('user_photos', 'users.id', '=', 'user_photos.user_id')
            // ->select('users.*', 'user_descriptions.*', 'user_photos.*')
            ->Where('id', 'LIKE', '%' . Auth::user()->id .  '%')
            ->first();

        $directory =  storage_path('app/public/avatars');
        $files = Storage::allFiles($directory);

        return view('user_security', ['users' => $users, 'files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|unique:users|max:255|email',
        ]);
        $email = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'email' => $request->input('email')
            ]);
        return redirect('user_security');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'bail|required|min:8|confirmed',
        ]);


        $pass = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'password' => Hash::make($request->input('password')),

            ]);

        return redirect('user_security');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSecurity  $userSecurity
     * @return \Illuminate\Http\Response
     */
    public function show(UserSecurity $userSecurity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSecurity  $userSecurity
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSecurity $userSecurity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSecurity  $userSecurity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSecurity $userSecurity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSecurity  $userSecurity
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSecurity $userSecurity)
    {
        //
    }
}
