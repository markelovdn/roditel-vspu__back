<?php

namespace App\Swagger\Controllers;

class ChildrensController
{

/**
 * @OA\Get(
 *      path="/api/parented/{parented}/children",
 *      operationId="getChildrenListForParent",
 *      tags={"CHILDRENS"},
 *      summary="Get list of childrens parent",
 *      description="Returns list of childrens parent",
 *      @OA\Parameter(
 *         description="integer, id родителя, /api/parented/1/children",
 *         in="query",
 *         name=""
 *         ),
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
 *     path="/api/parented/{parented}/children",
 *     summary="Adds a new childrn for parent",
 *     tags={"CHILDRENS"},
 *     @OA\Parameter(
 *         description="integer, id родителя, /api/parented/1/children",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="age",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="parentedId",
 *         required=true,
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Something went wrong in ChildrensController.store",
 *     )
 * )
 */

    public function store()
    {

    }

    /**
 * @OA\Get(
 *      path="/api/children/{child}",
 *      operationId="getChildren",
 *      tags={"CHILDRENS"},
 *      summary="Get children",
 *      description="Returns children",
 *      @OA\Parameter(
 *         description="integer, id ребенка, /api/children/1",
 *         in="query",
 *         name=""
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
    public function show(string $id)
    {

    }

/**
 * @OA\Put(
 *     path="/api/children/{child}",
 *     summary="Update children data",
 *     tags={"CHILDRENS"},
 *     @OA\Parameter(
 *         description="integer, id ребенка, /api/children/1",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="age",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer",
 *         in="path",
 *         name="parentedId",
 *         required=true,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *     @OA\Response(
 *         response=400,
 *         description="Something went wrong in ChildrensController.update",
 *     )
 * )
 */
    public function update()
    {

    }

/**
 * @OA\Delete(
 *     path="/api/children/{child}",
 *     summary="Delete children data",
 *     tags={"CHILDRENS"},
 *     @OA\Parameter(
 *         description="integer, id ребенка, /api/children/1",
 *         in="query",
 *         name=""
 *         ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Something went wrong in ChildrensController.update",
 *     )
 * )
 */

    public function destroy(string $id)
    {

    }
}
