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

    public function store()
    {

    }

    public function show(string $id)
    {

    }

    public function update()
    {

    }

    public function destroy(string $id)
    {

    }
}
