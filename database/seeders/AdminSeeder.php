<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat admin user dengan data default
        Admin::create([
            'name' => 'Admin Adhi',
            'email' => 'admin@adhi.com',
            'password' => Hash::make('adhikarya123'), // Jangan lupa ubah password sesuai kebutuhan
        ]);
    }
}