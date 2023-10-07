<?php

namespace App\Swagger\Controllers;

class RegionsController
{

    /**
     * @OA\Get(
     *      path="/api/regions",
     *      operationId="getRegionsList",
     *      tags={"REGIONS"},
     *      summary="Get list of regions",
     *      description="Returns list of regions",
     *     @OA\Response(
     *         response=200,
     *         description="Array of regions",
     *      ),
     *     )
     */

    public function index()
    {
    }

    /**
     * @OA\Post(
     *      path="/api/regions",
     *      operationId="storeRegions",
     *      tags={"REGIONS"},
     *      summary="Add new regions",
     *      description="Returns regions",
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="code",
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="title",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Region successfully added",
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
     *      path="/api/regions/{id}",
     *      operationId="showRegion",
     *      tags={"REGIONS"},
     *      summary="Show region",
     *      description="Returns region",
     *      @OA\Parameter(
     *         description="integer, id региона",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of region",
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
     *      path="/api/regions/{id}",
     *      operationId="updateRegion",
     *      tags={"REGIONS"},
     *      summary="Update region",
     *      @OA\Parameter(
     *         description="integer, id региона",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="code",
     *         ),
     *      @OA\Parameter(
     *         description="string, max=255",
     *         in="path",
     *         name="title",
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Region successfully updated",
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
     *      path="/api/regions/{id}",
     *      operationId="deleteRegions",
     *      tags={"REGIONS"},
     *      summary="Delete regions",
     *      @OA\Parameter(
     *         description="integer, id региона",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Region successfully deleted",
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
