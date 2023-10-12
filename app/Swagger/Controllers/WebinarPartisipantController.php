<?php

namespace App\Swagger\Controllers;

class WebinarPartisipantController
{

    /**
     * @OA\Get(
     *      path="/api/webinar/{webinarId}/webinarPartisipants",
     *      operationId="getWebinarPartisipantsList",
     *      tags={"WEBINAR_PARTISIPANTS"},
     *      summary="Get list of webinarPartisipants",
     *      description="Returns list of webinarPartisipants",
     *      @OA\Parameter(
     *         description="integer, id вебинара, /api/webinar/1/webinarPartisipants",
     *         in="query",
     *         name=""
     *         ),
     *      @OA\Response(
     *         response=200,
     *         description="Array of webinarPartisipants",
     *      ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *      ),
     *     )
     */

    public function index()
    {
    }

    /**
     * @OA\Post(
     *      path="/api/webinar/{webinarId}/webinarPartisipants",
     *      operationId="storeWebinarPartisipants",
     *      tags={"WEBINAR_PARTISIPANTS"},
     *      summary="Add new webinarPartisipants",
     *      @OA\Parameter(
     *         description="integer, id вебинара, /api/webinar/1/webinarPartisipants",
     *         in="query",
     *         name=""
     *         ),
     *      @OA\Parameter(
     *         description="integer",
     *         in="path",
     *         name="webinarId",
     *         ),
     *      @OA\Parameter(
     *         description="integer",
     *         in="path",
     *         name="userId",
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarPartisipant successfully added",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *      ),
     *     )
     */

    public function store()
    {
    }

    /**
     * @OA\Delete(
     *      path="/api/webinarPartisipants/{id}",
     *      operationId="deletewebinarPartisipants",
     *      tags={"WEBINAR_PARTISIPANTS"},
     *      summary="Delete webinarPartisipants",
     *      @OA\Parameter(
     *         description="integer, id записи в табице участников вебинара",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarPartisipant successfully deleted",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *      ),
     *     )
     */

    public function destroy()
    {
    }
}
