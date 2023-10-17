<?php

namespace App\Swagger\Controllers;

class ProfessionsController
{

    /**
     * @OA\Get(
     *      path="/api/professions",
     *      operationId="getProfessionList",
     *      tags={"PROFESSIONS"},
     *      summary="Get list of professions",
     *      description="Returns list of professions",
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
     *      path="/api/professions",
     *      operationId="storeProfession",
     *      tags={"PROFESSIONS"},
     *      summary="Add new profession",
     *      description="Returns profession",
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
     *      path="/api/professions/{id}",
     *      operationId="showProfession",
     *      tags={"PROFESSIONS"},
     *      summary="Show profession",
     *      description="Returns profession",
     *      @OA\Parameter(
     *         description="integer, id профессии",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
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
     *      path="/api/professions/{id}",
     *      operationId="updateProfession",
     *      tags={"PROFESSIONS"},
     *      summary="Update profession",
     *      @OA\Parameter(
     *         description="integer, id профессии",
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
     *      path="/api/professions/{id}",
     *      operationId="deleteProfession",
     *      tags={"PROFESSIONS"},
     *      summary="Delete professions",
     *      @OA\Parameter(
     *         description="integer, id профессии",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
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
