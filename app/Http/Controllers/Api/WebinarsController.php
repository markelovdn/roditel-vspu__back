<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Filters\WebinarFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarRequest;
use App\Http\Requests\UpdateWebinarRequest;
use App\Http\Resources\LectorResource;
use App\Http\Resources\WebinarQuestionsResource;
use App\Http\Resources\WebinarsResource;
use App\Models\Webinar;
use App\Models\WebinarQuestion;
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
        //TODO: сделать загрузку заглушки для логотипа вебинара
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
            $webinar->prefix_sertificate = $request->prefixSertificate;
            $webinar->number_sertificate = $request->numberSertificate;
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
        $webinar = Webinar::where('id', $id)->with('webinarCategory', 'questions', 'lectors')->first();

        return response()->json([
            'id' => $webinar->id,
            'title' => $webinar->title,
            'logo' => $webinar->logo,
            'webinarCategory' => [
                'id' => $webinar->webinarCategory->id,
                'title' => $webinar->webinarCategory->title
            ],
            'cost' => $webinar->cost,
            'videoLink' => $webinar->video_link,
            'date' => Carbon::parse($webinar->date)->format('d.m.Y'),
            'timeStart' => Carbon::parse($webinar->time_start)->format('H:i'),
            'timeEnd' => Carbon::parse($webinar->time_end)->format('H:i'),
            'questions' => WebinarQuestionsResource::collection($webinar->questions),
            'lectors' => LectorResource::collection($webinar->lectors)
        ]);
    }

    public function update(UpdateWebinarRequest $request, string $id, FilesHandler $filesHandler)
    {
        //TODO::сделать заглушку для логотипа

        $webinar = Webinar::where('id', $id)->first();
        $questions = json_decode($request->questions, true);
        $lectorsId = json_decode($request->lectors, true);

        try {
            $webinar->title = $request->title;
            $webinar->date = Carbon::parse($request->date)->format('Y-m-d');;
            $webinar->time_start = $request->timeStart;
            $webinar->time_end = $request->timeEnd;

            if ($request->hasFile('logo')) {
                $webinar->logo = $filesHandler->uploadWebinarLogo($request->logo);
            }

            $webinar->cost = $request->cost;
            $webinar->prefix_sertificate = $request->prefixSertificate;
            $webinar->number_sertificate = $request->numberSertificate;
            $webinar->video_link = $request->videoLink;
            $webinar->webinar_category_id = $request->webinarCategoryId;

            $webinar->save();

            if ($questions) {
                $questions = array_map(function ($question) {
                    return [
                        'question_text' => $question['questionText'],
                    ];
                }, $questions);
                DB::table('webinar_questions')->where('webinar_id', $id)->delete();
                $webinar->questions()->createMany($questions);
            }

            if ($lectorsId) {
                $lectorsId = array_map(function ($lectorId) {
                    return [
                        'lector_id' => $lectorId
                    ];
                }, $lectorsId);
                DB::table('lector_webinar')->where('webinar_id', $id)->delete();
                $webinar->lectors()->attach($lectorsId);
            }

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
        DB::transaction(function () use ($id) {
            DB::table('lector_webinar')->where('webinar_id', $id)->delete();
            WebinarQuestion::where('webinar_id', $id)->delete();
            Webinar::destroy($id);
        });

        return response()->json([
            'message' => 'Record webinar successfully deleted'
        ], 200);
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
