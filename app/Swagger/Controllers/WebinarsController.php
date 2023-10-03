<?php

namespace App\Swagger\Controllers;


class WebinarsController
{

/**
 * @OA\Get(
 *      path="/api/webinars",
 *      operationId="getWebinarsList",
 *      tags={"WEBINARS"},
 *      summary="Get list of webinars",
 *      description="Returns list of webinars",
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 *     )
 */

    public function index()
    {

    }

/**
 * @OA\Post(
 *     path="/api/webinars",
 *     summary="Adds a new webinar",
 *     tags={"WEBINARS"},
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="title",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="date",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="timeStart",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="timeEnd",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="lectorName",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="image:jpg,jpeg,png, maxSize=1MB",
 *         in="path",
 *         name="logo",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="cost",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="videoLink",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="webinarCategoryId",
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
 *      path="/api/webinars/{id}",
 *      operationId="getWebinarItem",
 *      tags={"WEBINARS"},
 *      summary="Get list of webinars",
 *      description="Returns list of webinars",
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 *     )
 */

    public function show()
    {

    }

/**
 * @OA\Put(
 *     path="/api/webinars/{id}",
 *     summary="Update webinar",
 *     tags={"WEBINARS"},
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="title",
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="date",
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="timeStart",
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="timeEnd",
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="lectorName",
 *     ),
 *     @OA\Parameter(
 *         description="image:jpg,jpeg,png, maxSize=1MB",
 *         in="path",
 *         name="logo",
 *     ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="cost",
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="videoLink",
 *     ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="webinarCategoryId",
 *     ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in WebinarsController.store",
 *     )
 * )
 */
    public function update()
    {

    }

/**
*/
    public function destroy()
    {

    }
}
