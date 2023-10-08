<?php

namespace Tests\Feature;

use App\Models\Consultant;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QuestionnairesTest extends TestCase
{
    // use DatabaseTransactions;

    public function test_index(): void
    {
        $questionnaire = Questionnaire::first();
        $consultant = Consultant::where('id', $questionnaire->consultant_id)->first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/consultant/'.$consultant->id.'/questionnaires');
        // $response->dd();

        $response->assertStatus(200)
        ->assertJsonFragment(['consultantId' => $consultant->id]);
    }

    public function test_store(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->post('/api/consultant/'.$consultant->id.'/questionnaires', [
            'title' => 'test title',
            'description' => 'test description',
            'answerBefore' => '10.08.2000',
            'questions' => [
                ['text' => 'test free',
                'answerType' => Question::FREE,
                'answers' => [
                    ['text' => 'Другое']
                ]
            ],
                ['text' => 'test one',
                'answerType' => Question::ONE,
                'answers' => [
                    ['text' => 'Первый'],
                    ['text' => 'Второй'],
                    ['text' => 'Третий']
                ]
                ],
                ['text' => 'test many',
                'answerType' => Question::MANY,
                'answers' => [
                    ['text' => 'Первый'],
                    ['text' => 'Второй'],
                    ['text' => 'Третий']
                ]]
            ]
        ]);

        // $response->dd();

        $this->assertDatabaseHas('questionnaires', [
            'title' => 'test title',
            'description' => 'test description'
        ]);

        $response->assertStatus(200)
        ->assertJsonFragment(["message" => "Questionnaire successfully added"]);
    }

    // public function test_show(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $region = Region::first();
    //     $response = $this->get('/api/regions/'.$region->id);

    //     $response->assertStatus(200)
    //     ->assertJsonIsObject();;
    // }

    // public function test_update(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $region = Region::first();

    //     $response = $this->put('/api/regions/'.$region->id, [
    //         'title' => 'test2'
    //     ]);

    //     $this->assertDatabaseHas('regions', [
    //         'title' => 'test2',
    //     ]);

    //     $response->assertStatus(200)
    //     ->assertJsonIsObject();;
    // }

    // public function test_destroy(): void
    // {
    //     $role = Role::where('code', Role::ADMIN)->first();
    //     $admin = User::where('role_id', $role->id)->first();
    //     Auth::login($admin);

    //     $region = Region::first();

    //     $response = $this->delete('/api/regions/'.$region->id);

    //     $this->assertSoftDeleted($region);

    //     $response->assertStatus(200)
    //     ->assertJsonIsObject();;
    // }
}
