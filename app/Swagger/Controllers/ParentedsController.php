<?php

namespace App\Swagger\Controllers;

class ParentedsController
{

    /**
     * @OA\Get(
     *      path="/api/parenteds",
     *      operationId="getParentedsList",
     *      tags={"PARENTEDS"},
     *      summary="Get list of parenteds",
     *      description="Returns list of parenteds",
     *     @OA\Response(
     *         response=200,
     *         description="Array of parenteds with user data",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized, need roleCode admin",
     *      ),
     *     )
     */

    public function index()
    {
    }

    /**
     * @OA\Get(
     *      path="/api/parenteds/{id}",
     *      operationId="showParented",
     *      tags={"PARENTEDS"},
     *      summary="Show parented",
     *      description="Returns parented",
     *      @OA\Parameter(
     *         description="integer, id родителя",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of parented",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized, need Auth user id === parent user id",
     *      ),
     *     )
     */

    public function show()
    {
    }

    /**
     * @OA\Put(
     *      path="/api/parenteds/{id}",
     *      operationId="updateParented",
     *      tags={"PARENTEDS"},
     *      summary="Update parented",
     *      @OA\Parameter(
     *         description="integer, id родителя",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *      @OA\Parameter(
     *         description="integer",
     *         in="path",
     *         name="regionId",
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="parented successfully updated",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized, need Auth user id === parent user id",
     *      ),
     *     )
     */

    public function update()
    {
    }

    /**
     * @OA\Delete(
     *      path="/api/parenteds/{id}",
     *      operationId="deleteParenteds",
     *      tags={"PARENTEDS"},
     *      summary="Delete parented",
     *      @OA\Parameter(
     *         description="integer, id родителя",
     *         in="query",
     *         name="",
     *         required=true
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="parented successfully deleted",
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized need roleCode admin",
     *      ),
     *     )
     */

    public function destroy()
    {
    }
}
