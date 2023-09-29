<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Children;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Parented;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use App\Models\WebinarCategory;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['code' => '1', 'title' => 'Республика Адыгея (Адыгея)'],
            ['code' => '2', 'title' => 'Республика Башкортостан '],
            ['code' => '3', 'title' => 'Республика Бурятия '],
            ['code' => '4', 'title' => 'Республика Алтай '],
            ['code' => '5', 'title' => 'Республика Дагестан '],
            ['code' => '6', 'title' => 'Республика Ингушетия '],
            ['code' => '7', 'title' => 'Кабардино-Балкарская Республика '],
            ['code' => '8', 'title' => 'Республика Калмыкия '],
            ['code' => '9', 'title' => 'Карачаево-Черкесская Республика '],
            ['code' => '10', 'title' => 'Республика Карелия '],
            ['code' => '11', 'title' => 'Республика Коми '],
            ['code' => '12', 'title' => 'Республика Марий Эл'],
            ['code' => '13', 'title' => 'Республика Мордовия '],
            ['code' => '14', 'title' => 'Республика Саха (Якутия)'],
            ['code' => '15', 'title' => 'Республика Северная Осетия — Алания'],
            ['code' => '16', 'title' => 'Республика Татарстан (Татарстан)'],
            ['code' => '17', 'title' => 'Республика Тыва '],
            ['code' => '18', 'title' => 'Удмуртская Республика '],
            ['code' => '19', 'title' => 'Республика Хакасия '],
            ['code' => '21', 'title' => 'Чувашская Республика (Чувашия)'],
            ['code' => '22', 'title' => 'Алтайский край '],
            ['code' => '23', 'title' => 'Краснодарский край '],
            ['code' => '24', 'title' => 'Красноярский край '],
            ['code' => '25', 'title' => 'Приморский край '],
            ['code' => '26', 'title' => 'Ставропольский край '],
            ['code' => '27', 'title' => 'Хабаровский край '],
            ['code' => '28', 'title' => 'Амурская область '],
            ['code' => '29', 'title' => 'Архангельская область '],
            ['code' => '30', 'title' => 'Астраханская область '],
            ['code' => '31', 'title' => 'Белгородская область '],
            ['code' => '32', 'title' => 'Брянская область '],
            ['code' => '33', 'title' => 'Владимирская область '],
            ['code' => '34', 'title' => 'Волгоградская область '],
            ['code' => '35', 'title' => 'Вологодская область '],
            ['code' => '36', 'title' => 'Воронежская область '],
            ['code' => '37', 'title' => 'Ивановская область '],
            ['code' => '38', 'title' => 'Иркутская область '],
            ['code' => '39', 'title' => 'Калининградская область '],
            ['code' => '40', 'title' => 'Калужская область '],
            ['code' => '41', 'title' => 'Камчатский край '],
            ['code' => '42', 'title' => 'Кемеровская область '],
            ['code' => '43', 'title' => 'Кировская область '],
            ['code' => '44', 'title' => 'Костромская область '],
            ['code' => '45', 'title' => 'Курганская область '],
            ['code' => '46', 'title' => 'Курская область '],
            ['code' => '47', 'title' => 'Ленинградская область '],
            ['code' => '48', 'title' => 'Липецкая область '],
            ['code' => '49', 'title' => 'Магаданская область '],
            ['code' => '50', 'title' => 'Московская область '],
            ['code' => '51', 'title' => 'Мурманская область '],
            ['code' => '52', 'title' => 'Нижегородская область '],
            ['code' => '53', 'title' => 'Новгородская область '],
            ['code' => '54', 'title' => 'Новосибирская область '],
            ['code' => '55', 'title' => 'Омская область '],
            ['code' => '56', 'title' => 'Оренбургская область '],
            ['code' => '57', 'title' => 'Орловская область '],
            ['code' => '58', 'title' => 'Пензенская область '],
            ['code' => '59', 'title' => 'Пермский край '],
            ['code' => '60', 'title' => 'Псковская область '],
            ['code' => '61', 'title' => 'Ростовская область '],
            ['code' => '62', 'title' => 'Рязанская область '],
            ['code' => '63', 'title' => 'Самарская область '],
            ['code' => '64', 'title' => 'Саратовская область '],
            ['code' => '65', 'title' => 'Сахалинская область '],
            ['code' => '66', 'title' => 'Свердловская область '],
            ['code' => '67', 'title' => 'Смоленская область '],
            ['code' => '68', 'title' => 'Тамбовская область '],
            ['code' => '69', 'title' => 'Тверская область '],
            ['code' => '70', 'title' => 'Томская область '],
            ['code' => '71', 'title' => 'Тульская область '],
            ['code' => '72', 'title' => 'Тюменская область '],
            ['code' => '73', 'title' => 'Ульяновская область '],
            ['code' => '74', 'title' => 'Челябинская область '],
            ['code' => '75', 'title' => 'Забайкальский край '],
            ['code' => '76', 'title' => 'Ярославская область '],
            ['code' => '77', 'title' => 'Москва  '],
            ['code' => '78', 'title' => 'Санкт-Петербург  '],
            ['code' => '79', 'title' => 'Еврейская автономная область'],
            ['code' => '80', 'title' => 'Донецкая Народная Республика'],
            ['code' => '81', 'title' => 'Луганская Народная Республика'],
            ['code' => '82', 'title' => 'Республика Крым '],
            ['code' => '83', 'title' => 'Ненецкий автономный округ'],
            ['code' => '84', 'title' => 'Херсонская область '],
            ['code' => '85', 'title' => 'Запорожская область '],
            ['code' => '86', 'title' => 'Ханты-Мансийский автономный округ — Югра'],
            ['code' => '87', 'title' => 'Чукотский автономный округ'],
            ['code' => '89', 'title' => 'Ямало-Ненецкий автономный округ'],
            ['code' => '92', 'title' => 'Севастополь  '],
            ['code' => '95', 'title' => 'Чеченская республика '],
        ]);

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

        Profession::insert([
            ['title' => 'Преподаватель ВУЗа'],
            ['title' => 'Электрик'],
            ['title' => 'Сантехник'],
        ]);

        WebinarCategory::insert([
            ['title' => 'Основная школа'],
            ['title' => 'Не основная школа'],
            ['title' => 'Вечерняя школа'],
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Contract::factory(10)->create();
        \App\Models\Parented::factory(10)->create();
        \App\Models\Children::factory(10)->create();
        \App\Models\Webinar::factory(10)->create();
        \App\Models\WebinarQuestion::factory(10)->create();
        \App\Models\WebinarProgram::factory(10)->create();
        \App\Models\ConsultantReport::factory(10)->create();
        \App\Models\Questionnaire::factory(10)->create();
        \App\Models\QuestionnaireQuestion::factory(10)->create();
        \App\Models\QuestionnaireAnswer::factory(10)->create();
        \App\Models\QuestionnaireParentedAnswer::factory(10)->create();
        \App\Models\QuestionnaireAnswerCount::factory(10)->create();
        \App\Models\Consultation::factory(10)->create();
        \App\Models\ConsultationMessage::factory(10)->create();
        \App\Models\WebinarPartisipant::factory(10)->create();

        User::insert([
            'first_name' => 'test',
            'second_name' => 'test',
            'patronymic' => 'test',
            'email' => 'test@test.ru',
            'phone' => '+7 (111) 111 1111',
            'role_id' => '3',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]
    );

    User::insert([
        'first_name' => 'admin',
        'second_name' => 'admin',
        'patronymic' => 'admin',
        'email' => 'admin@admin.ru',
        'phone' => '+7 (000) 000 0000',
        'role_id' => '1',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    ]
    );

        Consultant::create([
            'user_id' => '11',
            'photo' => 'https://via.placeholder.com/354x472.png/0033aa?text=people+accusantium',
            'specialization_id' => '1',
            'profession_id' => '1',
        ]);

        Contract::create([
            'consultant_id' => '11',
            'number' => '585',
        ]);

        DB::table('consultation_user')->insert([
            "consultation_id" => 1,
            "user_id" => 1
        ]);

        DB::table('users')
        ->whereIn('id', DB::table('parenteds')->select('user_id'))
        ->update(['role_id' => Role::where('code', Role::PARENTED)->first()->id]);

        DB::table('users')
        ->whereIn('id', DB::table('consultants')->select('user_id'))
        ->update(['role_id' => Role::where('code', Role::CONSULTANT)->first()->id]);

    }
}
