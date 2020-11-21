<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDescription;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


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
            ->join('user_photos', 'users.id', '=', 'user_photos.user_id')
            // ->select('users.*', 'user_descriptions.*', 'user_photos.*')
            ->Where('id', 'LIKE', '%' . Auth::user()->id .  '%')
            ->first();

        $directory =  storage_path('app/public/avatars');
        $files = Storage::allFiles($directory);

        return view('user_descriptions', ['users' => $users, 'files' => $files]);
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
        $data = new \DateTime();



        $user_create = User::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'id'   => Auth::user()->id,
        ], [
            'name' =>  $request->input('inputNickname'),
            'updated_at' => $data

        ]);

        $user_des = UserDescription::updateOrCreate([
            'user_id'   => Auth::user()->id,
        ], [
            'firstname' =>  $request->input('inputFirstname'),
            'lastname' =>  $request->input('inputLastname'),
            'middlename' =>  $request->input('inputMiddlename'),
            'contact' =>  $request->input('inputContact'),
            'address' =>  $request->input('inputAddress'),
            'updated_at' => $data

        ]);



        if ($request->hasFile('avatar') != null) {
            $sad = $request->file('avatar')->getClientOriginalName();
            $char = strval($sad);

            $user_photo = UserPhoto::updateOrCreate([
                'user_id'   => Auth::user()->id,
            ], [
                'photo' =>   $char,
            ]);
        } else {
            return redirect('user_descriptions');
        }



        // $path = $request->file('avatar')->store(
        //     'avatars/' .  Auth::user()->id,
        //     'public'
        // );


        // $path = $request->file('avatar')->storePublicly('avatars', 'public');

        // $name = $request->file('avatar')->getClientOriginalName();

        // $path = $request->file('avatar')->storePubliclyAs(
        //     'avatars/' .  Auth::user()->id,
        //     $name,
        //     'public'
        // );

        if ($request->hasFile('avatar')) {

            $image       = $request->file('avatar');
            $filename    = $image->getClientOriginalName();

            $image_resize = Image::make($image);
            $image_resize->resize(300, 300);

            $image_resize->save(public_path('avatars/'
                .  Auth::user()->id . '_' . $filename));
        }

        // $md5Name = md5_file($request->file('avatar')->getRealPath());
        // $guessExtension = $request->file('avatar')->guessExtension();
        // $file = $request->file('avatar')->storeAs('avatars', $md5Name . '.' . $guessExtension, 'public');

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
        $data = new \DateTime();

        $user_photo = UserPhoto::updateOrCreate([
            'user_id'   => Auth::user()->id,
        ], [
            'photo' =>  null,
            'updated_at' => $data
        ]);
        return redirect('user_descriptions');
    }
}
