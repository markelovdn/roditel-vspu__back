<?php

namespace App\Swagger\Controllers;

class WebinarQuestionsController
{

    /**
     * @OA\Get(
     *      path="/api/webinar/{webinarId}/webinarQuestions",
     *      operationId="getWebinarQuestionsList",
     *      tags={"WEBINAR_QUESTIONS"},
     *      summary="Get list of webinarQuestions",
     *      description="Returns list of webinarQuestions",
     *      @OA\Parameter(
     *         description="integer, id вебинара, /api/webinar/1/webinarQuestions",
     *         in="query",
     *         name=""
     *         ),
     *      @OA\Response(
     *         response=200,
     *         description="Array of webinarQuestions",
     *      ),
     *     )
     */

    public function index()
    {
    }

    /**
     * @OA\Post(
     *      path="/api/webinar/{webinarId}/webinarQuestions",
     *      operationId="storeWebinarQuestions",
     *      tags={"WEBINAR_QUESTIONS"},
     *      summary="Add new webinarQuestions",
     *      @OA\Parameter(
     *         description="integer, id вебинара, /api/webinar/1/webinarQuestions",
     *         in="query",
     *         name=""
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="questionText",
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarQuestion successfully added",
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
     * @OA\Get(
     *      path="/api/webinarQuestions/{id}",
     *      operationId="showWebinarQuestion",
     *      tags={"WEBINAR_QUESTIONS"},
     *      summary="Show webinarQuestion",
     *      description="Returns webinarQuestion",
     *      @OA\Parameter(
     *         description="integer, id вопроса вебинара",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of webinarQuestion",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *      ),
     *     )
     */

    public function show()
    {
    }

    /**
     * @OA\Put(
     *      path="/api/webinarQuestions/{id}",
     *      operationId="updateWebinarQuestion",
     *      tags={"WEBINAR_QUESTIONS"},
     *      summary="Update webinarQuestion",
     *      @OA\Parameter(
     *         description="integer, id вопроса к вебинару",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="questionText",
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarQuestion successfully updated",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *      ),
     *     )
     */

    public function update()
    {
    }

    /**
     * @OA\Delete(
     *      path="/api/webinarQuestions/{id}",
     *      operationId="deletewebinarQuestions",
     *      tags={"WEBINAR_QUESTIONS"},
     *      summary="Delete webinarQuestions",
     *      @OA\Parameter(
     *         description="integer, id вопроса к вебинару",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="webinarQuestion successfully deleted",
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
