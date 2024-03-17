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
    use DatabaseTransactions;

    public function test_index(): void
    {
        $questionnaire = Questionnaire::first();
        $consultant = Consultant::where('id', $questionnaire->consultant_id)->first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/consultant/' . $consultant->id . '/questionnaires');
        // $response->dd();

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $questionnaire->title]);
    }

    public function test_store(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->post(
            '/api/consultant/' . $consultant->id . '/questionnaires',
            [
                'title' => 'test title',
                'description' => 'test description',
                'answerBefore' => '10.08.2000',
                'questions' =>
                [
                    [
                        'text' => 'test free', 'description' => 'test description', 'type' => Question::TEXT,
                        'options' =>
                        [
                            ['text' => 'Другое']
                        ],
                        'other' =>
                        [
                            'show' => true,
                            'text' => 'Другое'
                        ]
                    ],

                    [
                        'text' => 'test one', 'description' => 'test description', 'type' => Question::SINGLE,
                        'options' =>
                        [
                            ['text' => 'Первый'],
                            ['text' => 'Второй'],
                            ['text' => 'Третий']
                        ],
                        'other' =>
                        [
                            'show' => true,
                            'text' => 'Другое'
                        ]
                    ],

                    [
                        'text' => 'test many', 'description' => 'test description', 'type' => Question::MANY,
                        'options' =>
                        [
                            ['text' => 'Первый'],
                            ['text' => 'Второй'],
                            ['text' => 'Третий']
                        ],
                        'other' =>
                        [
                            'show' => true,
                            'text' => 'Другое'
                        ]
                    ]
                ]
            ]
        );
        // $response->dd();

        $this->assertDatabaseHas('questionnaires', [
            'title' => 'test title',
            'description' => 'test description'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(["message" => "Questionnaire successfully added"]);
    }

    public function test_show(): void
    {
        $questionnaire = Questionnaire::first();
        $consultant = Consultant::where('id', $questionnaire->consultant_id)->first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/questionnaires/' . $questionnaire->id);
        // $response->dd();

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $questionnaire->title]);
    }

    public function test_update(): void
    {
        $questionnaire = Questionnaire::with('questions')->first();
        $consultant = Consultant::where('id', $questionnaire->consultant_id)->first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->put(
            '/api/questionnaires/' . $questionnaire->id,
            [
                'title' => 'test2 title2',
                'description' => 'test2 description2',
                'answerBefore' => '10.08.2000',
                'questions' =>
                [
                    [
                        'id' => $questionnaire->questions[0]->id, 'text' => 'test2 free2', 'description' => 'test description', 'type' => Question::TEXT,
                        'options' =>
                        [
                            ['id' => $questionnaire->questions[0]->options[0]->id, 'text' => 'Другое2']
                        ]
                    ],

                    [
                        'id' => $questionnaire->questions[1]->id, 'text' => 'test2 one2', 'description' => 'test description', 'type' => Question::SINGLE,
                        'options' =>
                        [
                            ['id' => $questionnaire->questions[1]->options[1]->id, 'text' => 'Первый2'],
                            ['id' => $questionnaire->questions[1]->options[1]->id, 'text' => 'Второй2'],
                            ['id' => $questionnaire->questions[1]->options[1]->id, 'text' => 'Третий2']
                        ]
                    ],

                    [
                        'id' => $questionnaire->questions[2]->id, 'text' => 'test2 many2', 'description' => 'test description', 'type' => Question::MANY,
                        'options' =>
                        [
                            ['id' => $questionnaire->questions[2]->options[2]->id, 'text' => 'Первый2'],
                            ['id' => $questionnaire->questions[2]->options[2]->id, 'text' => 'Второй2'],
                            ['id' => $questionnaire->questions[2]->options[2]->id, 'text' => 'Третий2']
                        ]
                    ]
                ]
            ]
        );
        // $response->dd();

        $this->assertDatabaseHas('questionnaires', [
            'title' => 'test2 title2',
            'description' => 'test2 description2'
        ]);

        $this->assertDatabaseHas('questions', [
            'text' => 'test2 free2',
            'answer_type' => Question::TEXT
        ]);

        $this->assertDatabaseHas('options', [
            'text' => 'Другое2',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(["message" => "Questionnaire successfully updated"]);
    }

    public function test_destroy(): void
    {
        $questionnaire = Questionnaire::with('questions')->first();
        $consultant = Consultant::where('id', $questionnaire->consultant_id)->first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->delete('/api/questionnaires/' . $questionnaire->id);

        $this->assertSoftDeleted($questionnaire);

        $response->assertStatus(200)
            ->assertJsonIsObject();
    }
}
