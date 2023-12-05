<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarPartisipantRequest;
use App\Models\WebinarPartisipant;
use App\Http\Resources\WebinarPartisipantsResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
            $fileUrl = config('filesystems.disks.public.url') . '/parenteds/Sertificate.pdf';
            FilesExport::webinarSertificateExport($fileUrl, $request->webinarId);

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
}
