<?php

namespace App\Swagger\Controllers;

class ConsultantsController
{

/**
 * @OA\Get(
 *      path="/api/consultants",
 *      operationId="getConsultantsList",
 *      tags={"CONSULTANTS"},
 *      summary="Get list of consultants",
 *      description="Returns list of consultants",
 *      @OA\Parameter(
 *         description="integer, номер страницы пагинаци, по 9 записей, /api/consultants?page=1",
 *         in="query",
 *         name="page",
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
 *     path="/api/consultants",
 *     operationId="storeConsultantsData",
 *     tags={"CONSULTANTS"},
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="userId",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="file, image:jpg,jpeg,png, maxSize=1MB",
 *         in="path",
 *         name="photo",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, max=65535",
 *         in="path",
 *         name="description",
 *         required=true,
 *     ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in WebinarsController.store",
 *     )
 * )
 */

    public function store()
    {

    }

/**
 * @OA\Get(
 *      path="/api/consultants/{consultant}",
 *      operationId="getConsultant",
 *      tags={"CONSULTANTS"},
 *      summary="Get consultant",
 *      description="Returns consultant",
 *      @OA\Parameter(
 *         description="integer, id консуьтанта, /api/consultants/1",
 *         in="query",
 *         name="",
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *     )
 */

    public function show(string $id)
    {

    }

/**
 * @OA\Put(
 *     path="/api/consultants/{consultant}",
 *     operationId="updateConsultantsData",
 *     tags={"CONSULTANTS"},
 *     @OA\Parameter(
 *         description="file, image:jpg,jpeg,png, maxSize=1MB",
 *         in="path",
 *         name="photo",
 *     ),
 *     @OA\Parameter(
 *         description="string, max=65535",
 *         in="path",
 *         name="description",
 *     ),
 *     @OA\Parameter(
 *         description="integer, id специализации",
 *         in="path",
 *         name="specializationId",
 *     ),
 *     @OA\Parameter(
 *         description="integer, id профессии",
 *         in="path",
 *         name="professionId",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in Something went wrong in UserController.update",
 *     )
 * )
 */

    public function update()
    {

    }

/**
 * @OA\Delete(
 *     path="/api/consultants/{consultant}",
 *     summary="Delete consultant data",
 *     tags={"CONSULTANTS"},
 *     @OA\Parameter(
 *         description="integer, id консультанта, /api/consultants/1",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Something went wrong in ConsultantController.update",
 *     )
 * )
 */

    public function destroy(string $id)
    {

    }
}
