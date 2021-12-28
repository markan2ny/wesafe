<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'address' => Str::random(10),
            'phone' => '09222222222',
            'password' => Hash::make('password'),
        ])
        ->attachRole('admin');

        for ($i=0; $i < 10; $i++) { 
            $user = User::create(
                [
                    'name' => Str::random(10),
                    'email' => Str::random(8).'@app.com',
                    'address' => Str::random(10),
                    'phone' => '09222222222',
                    'password' => Hash::make('password'),
                ]
            );
            $user->attachRole('user');
        }
    }
}
