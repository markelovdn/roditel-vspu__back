<?php

namespace App\Swagger\Controllers;

class ConsultantReportsController
{
/**
 * @OA\Get(
 *      path="/api/consultant/{consultant}/reports",
 *      operationId="storeConsultantReportList",
 *      tags={"CONSULTANT_REPORTS"},
 *      summary="Get list of consultant reports",
 *      description="Returns list of consultant reports",
 *      @OA\Parameter(
 *         description="integer, id консультанта, /api/consultant/1/reports",
 *         in="query",
 *         name=""
 *         ),
 *      @OA\Parameter(
 *         description="integer, номер страницы пагинаци, /api/consultant/1/reports?page=1",
 *         in="query",
 *         name="page",
 *         ),
 *     @OA\Parameter(
 *         description="string, отчеты в указанный промежуток дат, /api/consultant/1/reports?dateBetween=04.10.2023,07.10.2023",
 *         in="query",
 *         name="dateBetween",
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *     )
 */
    public function index()
    {

    }

/**
 * @OA\Post(
 *      path="/api/consultant/{consultant}/reports",
 *      tags={"CONSULTANT_REPORTS"},
 *      description="store consultant reports",
 *      @OA\Parameter(
 *         description="integer, id консультанта, /api/consultant/1/reports",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Parameter(
 *         description="file, type=*.xlsx",
 *         in="path",
 *         name="file",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer id консультанта",
 *         in="path",
 *         name="consultantId",
 *         required=true,
 *     ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in ConsultantReportController.store",
 *     )
 * )
 */

    public function store()
    {

    }

    /**
 * @OA\Get(
 *      path="api/reports/{report}",
 *      operationId="showConsultantReport",
 *      tags={"CONSULTANT_REPORTS"},
 *      summary="Get consultant report",
 *      description="Returns consultant report",
 *      @OA\Parameter(
 *         description="integer, id отчета, /api/reports/1",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *     )
 */

    public function show()
    {

    }

/**
 * @OA\Put(
 *      path="/api/reports/{report}",
 *      tags={"CONSULTANT_REPORTS"},
 *      description="update consultant reports",
 *      @OA\Parameter(
 *         description="integer, id отчета, /api/reports/1",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Parameter(
 *         description="file, type=*.xlsx",
 *         in="path",
 *         name="file",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer id консультанта",
 *         in="path",
 *         name="consultantId",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in ConsultantReportController.update",
 *     )
 * )
 */

    public function update()
    {

    }

/**
 * @OA\Delete(
 *     path="/api/reports/{report}",
 *     summary="Delete report data",
 *     tags={"CONSULTANT_REPORTS"},
 *      @OA\Parameter(
 *         description="integer, id отчета, /api/reports/1",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Something went wrong in ConsultantReportController.update",
 *     )
 * )
 */

    public function destroy()
    {

    }
}
