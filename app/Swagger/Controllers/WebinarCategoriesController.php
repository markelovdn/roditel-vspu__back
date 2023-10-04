<?php

namespace App\Swagger\Controllers;

class WebinarCategoriesController
{

    /**
 * @OA\Get(
 *      path="/api/webinarCategories",
 *      operationId="getWebinarCategoriesList",
 *      tags={"WEBINAR_CATEGORIES"},
 *      summary="Get list of webinar categories",
 *      description="Returns list of webinar categories",
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      )
 *     )
 */

    public function index(){}

/**
 * @OA\Post(
 *     path="/api/webinarCategories",
 *     summary="Adds a new webinar category",
 *     tags={"WEBINAR_CATEGORIES"},
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="title",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in WebinarCategoriesController.store",
 *     )
 * )
 */

    public function store(){}

/**
 * @OA\Get(
 *      path="/api/webinarCategories/{id}",
 *      operationId="getWebinarCategoriesItem",
 *      tags={"WEBINAR_CATEGORIES"},
 *      summary="Get webinar category item",
 *      description="Returns item of webinar categroy",
 *      @OA\Parameter(
 *         description="integer",
 *         in="query",
 *         name="id",
 *         required=true,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      )
 *     )
 */

    public function show(){}

/**
 * @OA\Put(
 *     path="/api/webinarCategories/{id}",
 *     summary="Adds a new webinar category",
 *     tags={"WEBINAR_CATEGORIES"},
 *     @OA\Parameter(
 *         description="integer",
 *         in="query",
 *         name="id",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="title",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in WebinarCategoriesController.store",
 *     )
 * )
 */

    public function update(){}

/**
 * @OA\Delete(
 *     path="/api/webinarCategories/{id}",
 *     summary="Delete webinar category",
 *     tags={"WEBINAR_CATEGORIES"},
 *     @OA\Parameter(
 *         description="integer",
 *         in="query",
 *         name="id",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="The entry cannot be deleted",
 *     )
 * )
 */

    public function destroy(){}
}
