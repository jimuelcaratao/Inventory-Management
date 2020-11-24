<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    public function index(Request $request)
    {
        // User Descriptions
        $users = DB::table('users')
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->join('user_photos', 'users.id', '=', 'user_photos.user_id')
            // ->select('users.*', 'user_descriptions.*', 'user_photos.*')
            ->Where('id', 'LIKE', '%' . Auth::user()->id .  '%')
            ->first();


        $tableUsers = User::all();

        if ($tableUsers->isEmpty()) {
            $user_collection = DB::table('users')
                ->paginate();
        } else {
            // ienumerable
            $user_collection = DB::table('users')
                ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id');
            // $user_collection = User::with(['user_descriptions']);
            // search validation
            $search = User::where('email', 'like', '%' . request()->search . '%')
                ->OrWhere('name', 'like', '%' . request()->search . '%')
                ->first();


            if ($search === null) {
                return redirect('users')->with('danger', 'Invalid Search');
            } else {
                $user_collection = $user_collection
                    ->where('email', 'like', '%' . request()->search . '%')
                    ->OrWhere('email', 'like', '%' . request()->search . '%')
                    // ->latest()
                    ->paginate(10);
            }
        }

        // foreach ($user_collection as $user_item) {
        //     $value = $user_item->password;
        //     $sad = Crypt::decrypt($value);
        // }


        return view('users', [
            'users' => $users,
            'user_collection' => $user_collection,

        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
