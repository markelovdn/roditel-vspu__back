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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WebinarsController extends Controller
{

    public function index(WebinarFilter $webinarFilter)
    {
        return WebinarsResource::collection(Webinar::with('webinarCategory', 'lectors')->filter($webinarFilter)
            ->orderBy('date', 'desc')
            ->paginate(4));
    }

    public function store(StoreWebinarRequest $request,  FilesHandler $filesHandler)
    {
        $webinar = new Webinar();
        $questions = json_decode($request->questions, true);
        $lectorsId = json_decode($request->lectors, true);

        try {
            $webinar->title = $request->title;
            $webinar->date = Carbon::parse($request->date)->format('Y-m-d');
            $webinar->time_start = $request->timeStart;
            $webinar->time_end = $request->timeEnd;
            $webinar->logo = $request->logo ? $filesHandler->uploadWebinarLogo($request->logo) : "";
            $webinar->cost = $request->cost;
            $webinar->video_link = $request->videoLink;
            $webinar->webinar_category_id = $request->webinarCategoryId;

            $webinar->save();

            if ($questions) {
                $questions = array_map(function ($question) {
                    return [
                        'question_text' => $question['questionText'],
                    ];
                }, $questions);

                $webinar->questions()->createMany($questions);
            }

            if ($lectorsId) {
                $lectorsId = array_map(function ($lectorId) {
                    return [
                        'lector_id' => $lectorId
                    ];
                }, $lectorsId);
                $webinar->lectors()->attach($lectorsId);
            }

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
        return new WebinarsResource(Webinar::where('id', $id)->with('webinarCategory', 'questions', 'lectors')->first());
    }

    public function update(UpdateWebinarRequest $request, string $id, FilesHandler $filesHandler)
    {
        //TODO::сделать заглушку для логотипа
        //TODO::переформатировать время и дату

        $webinar = Webinar::where('id', $id)->first();

        try {
            $webinar->title = $request->title;
            $webinar->date = $request->date;
            $webinar->time_start = $request->timeStart;
            $webinar->time_end = $request->timeEnd;
            $webinar->logo = $request->logo ? $filesHandler->uploadWebinarLogo($request->logo) : "";
            $webinar->cost = $request->cost;
            $webinar->video_link = $request->videoLink;
            $webinar->webinar_category_id = $request->webinarCategoryId;

            $webinar->save();

            return response()->json([
                'message' => 'Data webinar successfully update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in WebinarsController.update'
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

    public function getWebinarLectors()
    {
        $lectors = DB::table('webinar_lectors')
            ->select('lector_name')
            ->get();
        $res = [];
        foreach ($lectors as $lector) {
            array_push($res, $lector->lector_name);
        }

        $res = collect($res)->unique()->sort();
        return $res->values()->all();
    }
}
