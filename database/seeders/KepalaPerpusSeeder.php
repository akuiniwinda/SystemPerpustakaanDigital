<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KepalaPerpusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Winda Nur Azizah',
            'email' => 'kepalaperpus@gmail.com',
            'password' => Hash::make('kepalaperpus14'), // Password default
            'role' => 'kepalaperpus'
        ]);
    }
}
