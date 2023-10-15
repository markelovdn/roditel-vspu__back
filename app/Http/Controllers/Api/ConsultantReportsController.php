<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Filters\ConsultantReportsFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantReportsRequest;
use App\Http\Resources\ConsultantReportsResource;
use App\Models\Consultant;
use App\Models\ConsultantReport;
use Carbon\Carbon;
use Database\Factories\ConsultantReportFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConsultantReportsController extends Controller
{

    public function index(Request $request): Object
    {
        //TODO:не смог сдеать фильтр через скоуп, возникла проблема с использованием whereRaw в скоупе.
        $dateStart = Carbon::parse(Str::before($request->query('dateBetween'), ','))->format('Y-m-d');
        $dateEnd = Carbon::parse(Str::after($request->query('dateBetween'), ','))->format('Y-m-d');
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();

        $reports = ConsultantReportsResource::collection(
            ConsultantReport::where('consultant_id', $consultant->id)
            ->whereRaw('DATE(updated_at) >= ?', [$dateStart])
            ->whereRaw('DATE(updated_at) <= ?', [$dateEnd])
            ->paginate(6)
        );

        return response()->json([ 'reports' => json_decode(json_encode((object) $reports), true) ], 200);
    }

    public function store(StoreConsultantReportsRequest $request, FilesHandler $filesHandler)
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $report = new ConsultantReport();

        try {
            $report->file_url = $filesHandler->uploadConsultantReport($consultant->id, $request->file);
            $report->upload_status = $filesHandler->uploadConsultantReport($consultant->id, $request->file) ? ConsultantReport::UPLOAD_SUCCESSFUL : ConsultantReport::UPLOAD_FAILED;
            $report->consultant_id = $consultant->id;

            $report->save();

            return response()->json([
                'message' => 'Report successfully added'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantReportsController.store'
            ], 400);
        }
    }

    public function show(string $id)
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $reports = ConsultantReportsResource::collection(ConsultantReport::where('id', $id)->where('consultant_id', $consultant->id)->get());

        return response()->json([ 'reports' => json_decode(json_encode((object) $reports), true) ], 200);
    }

    public function update(StoreConsultantReportsRequest $request, string $report, FilesHandler $filesHandler)
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $report = ConsultantReport::where('id', $report)->where('consultant_id', $consultant->id)->first();

        try {
            $report->file_url = $filesHandler->uploadConsultantReport($consultant->id, $request->file);
            $report->upload_status = $filesHandler->uploadConsultantReport($consultant->id, $request->file) ? ConsultantReport::UPLOAD_SUCCESSFUL : ConsultantReport::UPLOAD_FAILED;
            $report->consultant_id = $consultant->id;

            $report->save();

            return response()->json([
                'message' => 'Report successfully updated'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantReportsController.update'
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        $report = ConsultantReport::where('id', $id)->first();

        try {
            $report->delete();
            return response()->json([
                'message' => 'Report successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantReportsController.destroy'
            ], 400);
        }
    }
}
