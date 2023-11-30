<?php

namespace App\Http\Controllers\Api;

use App\Events\ConsultationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageFromSocketRequest;
use App\Http\Resources\ConsultationMessagesResource;
use App\Models\Consultant;
use App\Models\Consultation;
use App\Models\ConsultationMessage;
use App\Models\Parented;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationMessagesController extends Controller
{

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $consultant = Consultant::where('user_id', $user->id)->first();

            $messages = ConsultationMessage::where('consultation_id', $request->consultationId)
                ->where('user_id', '!=', $user->id)->get();

            foreach ($messages as $message) {
                $message->readed = true;
                $message->save();
            }

            $message = new ConsultationMessage();
            $message->text = $request->text;
            $message->user_id = $user->id;
            $message->readed = false;
            $message->consultation_id = $request->consultationId;
            $message->save();

            if ($consultant) {
                //TODO: проверить на владельца консультации
                $consultation = Consultation::where('id', $request->consultationId)->with('users')->first();

                if (!DB::table('consultation_user')->where('user_id', auth()->user()->id)->where('consultation_id', $request->consultationId)->first()) {
                    return response()->json([
                        'message' => 'No access to consultation'
                    ], 423);
                }

                $parented = DB::table('consultation_user')
                    ->where('consultation_id', $request->consultationId)
                    ->where('owner', '=', true)
                    ->first();

                $consultant = DB::table('consultation_user')
                    ->where('consultation_id', $request->consultationId)
                    ->where('user_id', '=', $user->id)
                    ->first();

                DB::table('consultation_user')
                    ->where('consultation_id', $request->consultationId)
                    ->delete();


                $consultation->users()->attach([$consultant->user_id => ['owner' => false], $parented->user_id => ['owner' => true]]);
            }

            event(
                new ConsultationEvent(
                    $request->consultationId,
                    new ConsultationMessagesResource(ConsultationMessage::where('id', $message->id)->where('user_id', auth()->user()->id)->first())
                )
            );

            return response()->json([
                'message' => 'Message successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in MessageController.store'
            ], 423);
        }
    }

    public function show(string $id)
    {
        return ConsultationMessagesResource::collection(ConsultationMessage::where('id', $id)->where('user_id', auth()->user()->id)->get());
    }

    public function update(Request $request, string $id)
    {
        try {
            $user = auth()->user();

            $messages = ConsultationMessage::where('consultation_id', $request->consultationId)
                ->where('user_id', '!=', $user->id)->get();

            foreach ($messages as $message) {
                $message->readed = true;
                $message->save();
            }

            $message = ConsultationMessage::where('id', $id)
                ->where('consultation_id', $request->consultationId)
                ->where("user_id", $user->id)
                ->first();

            $message->text = $request->text;
            $message->user_id = $user->id;
            $message->readed = false;
            $message->consultation_id = $request->consultationId;
            $message->save();

            return response()->json([
                'message' => 'Message successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in MessageController.update'
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            ConsultationMessage::destroy($id);
            return response()->json([
                'message' => 'Record successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in MessageController.destroy'
            ], 400);
        }
    }
}
