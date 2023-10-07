<?php

namespace App\Swagger\Controllers;

class SpecializationsController
{

/**
 * @OA\Get(
 *      path="/api/specializations",
 *      operationId="getSpecializationsList",
 *      tags={"SPECIALIZATIONS"},
 *      summary="Get list of specializations",
 *      description="Returns list of specializations",
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
 *      path="/api/specializations",
 *      operationId="storeSpecialization",
 *      tags={"SPECIALIZATIONS"},
 *      summary="Add new specializations",
 *      description="Returns list of specializations",
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="title",
 *         required=true
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
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
 *      path="/api/specializations/{id}",
 *      operationId="showSpecialization",
 *      tags={"SPECIALIZATIONS"},
 *      summary="Show specialization",
 *      description="Returns specialization",
 *      @OA\Parameter(
 *         description="integer, id специализации",
 *         in="query",
 *         name="",
 *         required=true
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
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
 *      path="/api/specializations/{id}",
 *      operationId="updateSpecialization",
 *      tags={"SPECIALIZATIONS"},
 *      summary="Update specialization",
 *      @OA\Parameter(
 *         description="integer, id специализации",
 *         in="query",
 *         name="",
 *         required=true
 *         ),
 *      @OA\Parameter(
 *         description="string, max=255",
 *         in="path",
 *         name="title",
 *         required=true
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
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
 *      path="/api/specializations/{id}",
 *      operationId="deleteSpecialization",
 *      tags={"SPECIALIZATIONS"},
 *      summary="Delete specialization",
 *      @OA\Parameter(
 *         description="integer, id специализации",
 *         in="query",
 *         name="",
 *         required=true
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
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
