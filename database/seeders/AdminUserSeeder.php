<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем или обновляем пользователя
        $admin = User::updateOrCreate(
            ['email' => 'miki23074@gmail.com'], // Условие поиска
            [
                'name' => 'Miki',
                'password' => Hash::make('123123123'), // Замените на свой пароль
                'email_verified_at' => now(),
            ]
        );

        // Назначаем роль (убедитесь, что RoleSeeder уже был запущен)
        if (Role::where('name', 'admin')->exists()) {
            $admin->assignRole('admin');
            $this->command->info('Admin role assigned to miki23074@gmail.com');
        } else {
            $this->command->error('Role "admin" not found. Run RoleSeeder first!');
        }
    }
}
