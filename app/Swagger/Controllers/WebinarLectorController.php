<?php

namespace App\Swagger\Controllers;

class WebinarLectorController
{

 /**
 * @OA\Get(
 *      path="/api/webinar/{webinarId}/webinarLectors",
 *      operationId="getWebinarLectorsList",
 *      tags={"WEBINAR_LECTORS"},
 *      summary="Get list of webinarLectors",
 *      description="Returns list of webinarLectors",
 *      @OA\Parameter(
 *         description="integer, id лектора, /api/webinar/1/webinarLectors",
 *         in="query",
 *         name=""
 *         ),
 *      @OA\Response(
 *         response=200,
 *         description="Array of webinarLectors",
 *      ),
 *     )
 */
public function index(){}

/**
 * @OA\Post(
 *      path="/api/webinar/{webinarId}/webinarLectors",
 *      operationId="storeWebinarLectors",
 *      tags={"WEBINAR_LECTORS"},
 *      summary="Add new webinarLectors",
 *      @OA\Parameter(
 *         description="integer, id лектора, /api/webinar/1/webinarLectors",
 *         in="query",
 *         name=""
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="lectorName",
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="lectorDescription",
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="lectorDepartment",
 *         ),
 *      @OA\Parameter(
 *         description="file, image:jpg,jpeg,png, maxSize=1MB",
 *         in="path",
 *         name="lectorPhoto",
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="webinarLector successfully added",
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
  *      path="/api/webinarLectors/{id}",
  *      operationId="showWebinarLector",
  *      tags={"WEBINAR_LECTORS"},
  *      summary="Show webinarLector",
  *      description="Returns webinarLector",
  *      @OA\Parameter(
  *         description="integer, id лектора",
  *         in="query",
  *         name="",
  *         required=true
  *         ),
  *     @OA\Response(
  *         response=200,
  *         description="Array of webinarLector",
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
 *      path="/api/webinarLectors/{id}",
 *      operationId="updateWebinarLector",
 *      tags={"WEBINAR_LECTORS"},
 *      summary="Update webinarLector",
 *      @OA\Parameter(
 *         description="integer, id лектора, /api/webinar/1/webinarLectors",
 *         in="query",
 *         name=""
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="lectorName",
 *         required=true
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="lectorDescription",
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="lectorDepartment",
 *         ),
 *      @OA\Parameter(
 *         description="file, image:jpg,jpeg,png, maxSize=1MB",
 *         in="path",
 *         name="lectorPhoto",
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="webinarLector successfully updated",
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
 *      path="/api/webinarLectors/{id}",
 *      operationId="deletewebinarLectors",
 *      tags={"WEBINAR_LECTORS"},
 *      summary="Delete webinarLectors",
 *      @OA\Parameter(
 *         description="integer, id вопроса к вебинару",
 *         in="query",
 *         name="",
 *         required=true
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="webinarLector successfully deleted",
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
