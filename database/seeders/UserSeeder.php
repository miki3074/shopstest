<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $seller = User::create([
            'name' => 'Seller',
            'email' => 'sss@mail.ru',
            'password' => Hash::make('password'),
        ]);
        $seller->assignRole('seller');

        $buyer = User::create([
            'name' => 'Buyer',
            'email' => 'bbb@mail.ru',
            'password' => Hash::make('password'),
        ]);
        $buyer->assignRole('buyer');
    }
}
