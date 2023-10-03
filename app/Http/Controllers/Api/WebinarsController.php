<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Filters\WebinarFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarRequest;
use App\Http\Requests\UpdateWebinarRequest;
use App\Http\Resources\WebinarsResource;
use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebinarsController extends Controller
{

    public function index(WebinarFilter $webinarFilter, Request $request)
    {
        return WebinarsResource::collection(Webinar::with('webinarCategory')->filter($webinarFilter)->paginate(19));
    }

    public function store(StoreWebinarRequest $request,  FilesHandler $filesHandler)
    {

        $webinar = new Webinar();

        try {
            $webinar->title = $request->title;
            $webinar->date = $request->date;
            $webinar->time_start = $request->timeStart;
            $webinar->time_end = $request->timeEnd;
            $webinar->lector_name = $request->lectorName;
            $webinar->logo = $filesHandler->uploadWebinarLogo($request->logo);
            $webinar->cost = $request->cost;
            $webinar->video_link = $request->videoLink;
            $webinar->webinar_category_id = $request->webinarCategoryId;

            $webinar->save();

            return response()->json([
                'message' => 'Data webinar successfully added'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantController.store'
            ], 400);
        }
    }

    public function show(string $id)
    {
        return WebinarsResource::collection(Webinar::where('id', $id)->with('webinarCategory', 'questions')->get());;
    }

    public function update(UpdateWebinarRequest $request, string $id, FilesHandler $filesHandler)
    {
        $webinar = Webinar::where('id', $id)->first();

        try {
            $webinar->title = $request->title;
            $webinar->date = $request->date;
            $webinar->time_start = $request->timeStart;
            $webinar->time_end = $request->timeEnd;
            $webinar->lector_name = $request->lectorName;
            $webinar->logo = $filesHandler->uploadWebinarLogo($request->logo);
            $webinar->cost = $request->cost;
            $webinar->video_link = $request->videoLink;
            $webinar->webinar_category_id = $request->webinarCategoryId;

            $webinar->save();

            return response()->json([
                'message' => 'Data webinar successfully update'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in WebinarsController.store'
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        // try {
        //     Webinar::destroy($id);
        //     return response()->json([
        //         'message' => 'Record webinar successfully deleted'
        //     ], 200);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'error' => $e->getMessage(),
        //         'message' => 'Something went wrong in WebinarsController.destroy'
        //     ], 400);
        // }
    }
}
