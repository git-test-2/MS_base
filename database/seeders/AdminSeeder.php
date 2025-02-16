<?php

namespace Database\Seeders;

use App\Models\AdminUser; // Подключаем модель
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Для хэширования пароля

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
            'name' => 'Admin_3',               // Имя администратора
            'email' => 'admin_3@mindspace.test', // Email администратора
            'password' => Hash::make('password123db_3'), // Хэшируем пароль
        ]);
    }
}
