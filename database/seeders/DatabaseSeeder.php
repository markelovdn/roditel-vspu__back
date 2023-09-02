<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contract;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['code' => 'admin', 'title' => 'Администратор'],
            ['code' => 'consultant', 'title' => 'Консультант'],
            ['code' => 'parented', 'name' => 'Родитель']
        ]);

        Specialization::insert([
            ['title' => 'Школьники'],
            ['title' => 'Дошкольники'],
            ['title' => 'ОВЗ'],
            ['title' => 'ИТД'],
            ['title' => 'ИТП'],
        ]);

        Profession::insert([
            ['title' => 'Преподаватель ВУЗа'],
            ['title' => 'Электрик'],
            ['title' => 'Сантехник'],
        ]);


        \App\Models\User::factory(10)->create();
        \App\Models\Consultant::factory(10)->create();

    }
}
