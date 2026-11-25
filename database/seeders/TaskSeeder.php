<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        Task::updateOrCreate(
            [
                'user_id' => $user->id,
                'title' => 'Review Laravel CRUD',
            ],
            [
                'description' => 'Check the create, edit, update, and archive features.',
                'due_date' => now()->addDays(3),
                'status' => 'pending',
                'is_archived' => false,
            ]
        );

        Task::updateOrCreate(
            [
                'user_id' => $user->id,
                'title' => 'Test email notification',
            ],
            [
                'description' => 'Confirm that an email is generated when a task is marked done.',
                'due_date' => now()->addDays(5),
                'status' => 'done',
                'is_archived' => false,
            ]
        );
    }
}