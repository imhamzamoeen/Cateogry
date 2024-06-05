<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => '12345678',
            'user_type' => 'Super_Admin',
        ]);
        $user->assignRole('Super_Admin');
    }
}
