<?php

use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'michael@michaelneely.net')->first();

        if (!$user) {
            User::create([
                'name' => 'Michael Neely',
                'email' => 'michael@michaelneely.net',
                'role' => 'admin',
                'password' => Hash::make('password')


            ]);
        }
    }
}
