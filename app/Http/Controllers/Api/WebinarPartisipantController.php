<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarPartisipantRequest;
use App\Models\WebinarPartisipant;
use App\Http\Resources\WebinarPartisipantsResource;
use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class WebinarPartisipantController extends Controller
{
    public function index($webinarId): JsonResource
    {
        return WebinarPartisipantsResource::collection(WebinarPartisipant::where('webinar_id', $webinarId)->get());
    }

    public function store(StoreWebinarPartisipantRequest $request)
    {
        $webinarPartisipant = new WebinarPartisipant();

        if (!$webinarPartisipant->isUnique($request->webinarId, $request->userId)) {
            return response()->json([
                'error' => 'The participant is already registered'
            ], 400);
        }

        try {
            $webinarPartisipant->webinar_id = $request->webinarId;
            $webinarPartisipant->user_id = $request->userId;

            $webinarPartisipant->save();

            return response()->json([
                'message' => 'User successfully added for webinar'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in WebinarPartisipantsController.store'
            ], 400);
        }
    }

    public function destroy($id)
    {
        //TODO::сделать проверку на соответвие юзера вебинара и авторизованного пользователя или админа
        try {
            WebinarPartisipant::destroy($id);

            return response()->json([
                'message' => 'User successfully deleted for webinar'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in WebinarPartisipantsController.destroy'
            ], 400);
        }
    }

    public function downloadSertificate(Request $request)
    {
        $webinar = Webinar::where('id', $request->webinarId)->first();

        $a = Carbon::parse(now())->format('Y-m-d');
        $b = $webinar->date;
        $c = $b > $a;

        if (!$webinar || $webinar->date > Carbon::parse(now())->format('Y-m-d')) {
            return response()->json([
                'error' => 'Webinar not found or download link not available'
            ], 400);
        }
        $link_sertificate = FilesExport::webinarSertificateExport($request->webinarId);

        DB::table('webinar_partisipants')
            ->where('webinar_id', $request->webinarId)
            ->where('user_id', $request->userId)
            ->update(['link_sertificate' => $link_sertificate]);

        return $link_sertificate;
    }
}
