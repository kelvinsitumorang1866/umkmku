<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeds extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
             'Role' =>'Admin',
             'foto'=> 'random.jpg',
             'NIK'=> 12345678           ] );
            User::create([

                'name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'),
                'Role' =>'User',
                 'foto'=> 'random.jpg',
                 'NIK'=> 12345678   ] );  
                User::create([

                    'name' => 'Admin3',
                    'email' => 'admin3@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345'),
                    'Role' =>'User',
                    'foto'=> 'random.jpg',
                    'NIK'=> 12345678 ] );      
    }
}
