<?php

namespace Tests\Feature;

use App\Models\Consultant;
use App\Models\ConsultantReport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ConsultantReportTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_consultantReports(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $response = $this->get('/api/consultant/'.$consultant->id.'/reports');

        $response->assertStatus(200)->assertJsonIsObject();
    }

    // public function test_store_consultantReports(): void
    // {
    //     $consultant = Consultant::first();
    //     $user = User::where('id', $consultant->user_id)->first();
    //     Auth::login($user);

    //     $response = $this->post('/api/consultant/'.$consultant->id.'/reports', [
    //         'file' => UploadedFile::fake()->create('invoice.xlsx', 2),
    //         'uploadStatus' => ConsultantReport::UPLOAD_SUCCESSFUL,
    //     ]);

    //     $response->assertStatus(200)->assertJsonIsObject();
    // }

    public function test_show_consultantReports(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);
        $report = ConsultantReport::where('consultant_id', $consultant->id)->first();

        $response = $this->get('/api/reports/'.$report->id);

        $response->assertStatus(200)->assertJsonIsObject();
    }

    // public function test_update_consultantReports(): void
    // {
    //     $consultant = Consultant::first();
    //     $user = User::where('id', $consultant->user_id)->first();
    //     Auth::login($user);

    //     $report = ConsultantReport::where('consultant_id', $consultant->id)->first();

    //     $response = $this->put('/api/reports/'.$report->id, [
    //         'file' => UploadedFile::fake()->create('invoice2.xlsx', 2),
    //         'uploadStatus' => ConsultantReport::UPLOAD_SUCCESSFUL,
    //     ]);

    //     $response->assertStatus(200)->assertJsonIsObject();
    // }

    public function test_delete_consultantReports(): void
    {
        $consultant = Consultant::first();
        $user = User::where('id', $consultant->user_id)->first();
        Auth::login($user);

        $report = ConsultantReport::where('consultant_id', $consultant->id)->first();

        $response = $this->delete('/api/reports/'.$report->id);

        $this->assertDatabaseMissing('consultant_reports', [
            'id' => $report->id
        ]);

        $response->assertStatus(200)->assertJsonIsObject();
    }
}
