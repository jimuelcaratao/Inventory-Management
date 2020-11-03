<?php

namespace App\Http\Controllers;

use App\Models\UserDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserDescriptionController extends Controller
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
            ->Where('user_id', 'LIKE', '%' . Auth::user()->id .  '%')
            // ->select('users.*', 'user_descriptions.*')
            ->first();

        return view('user_descriptions', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user_des = UserDescription::updateOrCreate(
        //     [
        //         'user_id' => Auth::user()->id,


        //     ]
        // );

        $user_des = UserDescription::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'user_id'   => Auth::user()->id,
        ], [
            'firstname' =>  $request->input('inputFirstname'),
            'lastname' =>  $request->input('inputLastname'),
            'middlename' =>  $request->input('inputMiddlename'),
            'contact' =>  $request->input('inputContact'),
            'address' =>  $request->input('inputAddress'),
        ]);
        return redirect('user_descriptions')->with('success', 'Sucessfully Edited!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDescription  $userDescription
     * @return \Illuminate\Http\Response
     */
    public function show(UserDescription $userDescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDescription  $userDescription
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDescription $userDescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDescription  $userDescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDescription $userDescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDescription  $userDescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDescription $userDescription)
    {
        //
    }
}
