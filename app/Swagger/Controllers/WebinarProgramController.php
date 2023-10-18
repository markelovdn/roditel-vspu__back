<?php

namespace App\Swagger\Controllers;

class WebinarProgramController
{

    /**
     * @OA\Get(
     *      path="/api/webinar/{webinarId}/webinarPrograms",
     *      operationId="getWebinarProgramsList",
     *      tags={"WEBINAR_PROGRAMS"},
     *      summary="Get list of webinarPrograms",
     *      description="Returns list of webinarPrograms",
     *      @OA\Parameter(
     *         description="integer, id программы, /api/webinar/1/webinarPrograms",
     *         in="query",
     *         name=""
     *         ),
     *      @OA\Response(
     *         response=200,
     *         description="Array of webinarPrograms",
     *      ),
     *     )
     */

    public function index()
    {
    }

    /**
     * @OA\Post(
     *      path="/api/webinar/{webinarId}/webinarPrograms",
     *      operationId="storeWebinarPrograms",
     *      tags={"WEBINAR_PROGRAMS"},
     *      summary="Add new webinarPrograms",
     *      @OA\Parameter(
     *         description="integer, id программы, /api/webinar/1/webinarPrograms",
     *         in="query",
     *         name=""
     *         ),
     *      @OA\Parameter(
     *         description="string, example 10:00",
     *         in="path",
     *         name="timeStart",
     *         required=true
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="subject",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarProgram successfully added",
     *      ),
     *     @OA\Response(
     *         response=400,
     *         description="Permissions denied",
     *      ),
     *     )
     */

    public function store()
    {
    }

    /**
     * @OA\Get(
     *      path="/api/webinarPrograms/{id}",
     *      operationId="showWebinarProgram",
     *      tags={"WEBINAR_PROGRAMS"},
     *      summary="Show webinarProgram",
     *      description="Returns webinarProgram",
     *      @OA\Parameter(
     *         description="integer, id программы",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of webinarProgram",
     *      ),
     *     @OA\Response(
     *         response=400,
     *         description="Permissions denied",
     *      ),
     *     )
     */

    public function show()
    {
    }

    /**
     * @OA\Put(
     *      path="/api/webinarPrograms/{id}",
     *      operationId="updateWebinarProgram",
     *      tags={"WEBINAR_PROGRAMS"},
     *      summary="Update webinarProgram",
     *      @OA\Parameter(
     *         description="integer, id вопроса к вебинару",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *      @OA\Parameter(
     *         description="string, example 10:00",
     *         in="path",
     *         name="timeStart",
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="subject",
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarProgram successfully updated",
     *      ),
     *     @OA\Response(
     *         response=400,
     *         description="Permissions denied",
     *      ),
     *     )
     */

    public function update()
    {
    }

    /**
     * @OA\Delete(
     *      path="/api/webinarPrograms/{id}",
     *      operationId="deletewebinarPrograms",
     *      tags={"WEBINAR_PROGRAMS"},
     *      summary="Delete webinarPrograms",
     *      @OA\Parameter(
     *         description="integer, id вопроса к вебинару",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarProgram successfully deleted",
     *      ),
     *     @OA\Response(
     *         response=400,
     *         description="Permissions denied",
     *      ),
     *     )
     */

    public function destroy()
    {
    }
}
