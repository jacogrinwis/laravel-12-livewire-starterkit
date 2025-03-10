<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'ADMIN',
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@example.com',
                'password' => Hash::make('password'),
                'role' => 'EDITOR',
            ],
            [
                'name' => 'Viewer',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'VIEWER',
            ]
        ];

        foreach ($users as $userData) {
            $user = User::factory()->create($userData);

            // Mail::to($user->email)->send(new NewUserRegisteredMail($user));

            // Mail::to(config('mail.admin_address'))->send(new NewUserNotificationMail($user));
        }
    }
}