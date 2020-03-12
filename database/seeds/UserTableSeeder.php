<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('Lucia'),
                'access' => 0,
                // Password Launch
            ]
        );

        $student = User::create(
            [
                'name' => 'Student',
                'email' => 'student@school.com',
                'password' => Hash::make('abc123'),
                'access' => 1,
                // Password abcd
            ]
        );

        $teacher = User::create(
            [
                'name' => 'Teacher',
                'email' => 'teacher@school.com',
                'password' => Hash::make('y=mx+c'),
                'access' => 2,
                // Password y=mx+c
            ]
        );
    }
}
