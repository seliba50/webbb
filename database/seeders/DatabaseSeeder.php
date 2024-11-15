<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user =User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@higherlearning.com',
            "password" =>"Admin@123"
        ]);
        Admin::factory()->create([
            'user_id'=>$user->id
        ]);
    }
}
