<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Consultant;
use App\Models\ConsultationMessage;
use App\Models\Parented;
use App\Models\Questionnaire;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $questionnaires = 0;

        $parented = Parented::where('user_id', $user->id)->first();
        $consultant = Consultant::where('user_id', $user->id)->first();

        $messages = ConsultationMessage::where('user_id', auth()->user()->id)->where('readed', false)->count();

        if ($parented) {
            $questionnaires = Questionnaire::whereHas('parented', function ($query) use ($parented) {
                $query->where('parented_id', $parented->id)
                    ->where('answered', false);
            })->count();
        }

        if ($consultant) {
            $questionnairesConsultant = Questionnaire::where('consultant_id', $consultant->id)->pluck('id')->toArray();

            $questionnaires = DB::table('parented_questionnaire')->whereIn('questionnaire_id', $questionnairesConsultant)->where('answered', true)->where('readed', false)->count();
        }

        return json_encode([
            'messages' => $messages,
            'questionnaires' => $questionnaires,
            'count' =>  $messages + $questionnaires
        ]);
    }

    public function update()
    {
        try {
            $user = auth()->user();
            $parented = Parented::where('user_id', $user->id)->first();
            $consultant = Consultant::where('user_id', $user->id)->first();

            if (request()->query('messages') == true) {
                ConsultationMessage::where('user_id', auth()->user()->id)->where('readed', false)->update(['readed' => true]);
            }

            if ($parented && request()->query('questionnaires') == true) {
                Questionnaire::whereHas('parented', function ($query) use ($parented) {
                    $query->where('parented_id', $parented->id)
                        ->where('answered', false);
                })->update(['answered' => true]);
            }

            if ($consultant && request()->query('questionnaires') == true) {
                $questionnairesConsultant = Questionnaire::where('consultant_id', $consultant->id)->pluck('id')->toArray();

                DB::table('parented_questionnaire')->whereIn('questionnaire_id', $questionnairesConsultant)->where('readed', false)->update(['readed' => true]);
            }

            return response()->json([
                'message' => 'Notifications successfully update'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in Notification.update'
            ], 400);
        }
    }
}
