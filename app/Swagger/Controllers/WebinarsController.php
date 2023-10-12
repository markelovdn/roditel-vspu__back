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
*      @OA\Parameter(
 *         description="integer, номер страницы пагинаци, /api/webinars?page=1",
 *         in="query",
 *         name="page",
 *         ),
 *      @OA\Parameter(
 *         description="integer, webinarCategoryId (from /api/webinarCategories), /api/webinars?category=1, ",
 *         in="query",
 *         name="category",
 *         ),
 *     @OA\Parameter(
 *         description="string, Предстоящие, текущие или архивные вебинары, /api/webinars?actual=yes или /api/webinars?actual=no",
 *         in="query",
 *         name="actual",
 *         ),
 *     @OA\Parameter(
 *         description="string, Вебинары в указанный промежуток дат, /api/webinars?dateBetween=04.10.2023,07.10.2023",
 *         in="query",
 *         name="dateBetween",
 *         ),
 *     @OA\Parameter(
 *         description="string, Вебинары выбранные из выпадающего списка лекторов, /api/webinars?lector=Иванов И.И.",
 *         in="query",
 *         name="lector",
 *         ),
 *     @OA\Parameter(
 *         description="string, Поиск по полю названия вебинара, /api/webinars?searchField=дошкольник",
 *         in="query",
 *         name="searchField",
 *         ),
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
 *         required=true,
 *     ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in WebinarsController.store",
 *     ),
 *
 *      @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Data webinar successfully added",
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
 *         description="Something went wrong in WebinarsController.update",
 *     ),
 *
 *      @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *     ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Data webinar successfully update",
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

/**
 * @OA\Get(
 *      path="/api/webinarLectors",
 *      operationId="getWebinarLectors",
 *      tags={"WEBINARS"},
 *      summary="Получение массива лекторов для выпадающего списка фильтрации",
 *      description="Получение массива лекторов для выпадающего списка фильтрации",
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
    public function getWebinarLectors() {}
}
