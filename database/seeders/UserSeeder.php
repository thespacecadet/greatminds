<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use HasFactory;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->create()->each(function ($user) {
                $messages = Message::factory()->count(3)->create(['user_id' => $user->id]);
                $user->messages()->savemany($messages);
            });

    }
}
