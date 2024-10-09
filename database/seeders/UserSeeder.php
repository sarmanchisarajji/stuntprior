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
        User::create([
            'username' => 'dinkes12345',
            'password' => Hash::make('dinkes12345'),
            'nama_lengkap' => 'Endah Sekar',
            'jenis_kelamin' => 'perempuan',
            'user_type' => 'dinkes',
        ]);
    }
}
