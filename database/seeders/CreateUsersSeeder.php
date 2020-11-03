<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserDescription;
use Illuminate\Support\Str;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'sad',
        //     'email' => 'sad@gmail.com',
        //     'password' => Hash::make('qweqweqwe'),
        //     'is_admin' => '1',
        // ]);


        $user = User::create([
            'name' => 'sad',
            'email' => 'sad@gmail.com',
            'password' => Hash::make('qweqweqwe'),
            'is_admin' => '1',
        ]);

        $user_des = UserDescription::create([
            'user_description_id' => $user->id,
            'user_id' => $user->id,
        ]);
        return $user;
    }
}
