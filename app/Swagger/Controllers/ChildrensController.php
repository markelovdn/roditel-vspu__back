<?php

namespace App\Swagger\Controllers;

class ChildrensController
{

    /**
 * @OA\Get(
 *      path="/api/parented.children",
 *      operationId="getChildrenListForParent",
 *      tags={"CHILDRENS"},
 *      summary="Get list of childrens",
 *      description="Returns list of childrens",
*     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *         oneOf={
 *              @OA\Schema(
 *                  schema="User response",
 *                  title="Sample schema users list",
 *                  @OA\Property(
 * 		                property="childrens",
 * 		                type="object",
 *                          @OA\Property(
 * 		                        property="id",
 * 		                        type="integer"
 * 	                            ),
 * 	                        @OA\Property(
 * 		                        property="age",
 * 		                        type="integer"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="parented_id",
 * 		                        type="integer"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="created_at",
 * 		                        type="string"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="updated_at",
 * 		                        type="string"
 * 	                            )
 * 	                    ),
 * 	                )
 *        },
 *
 *        )
 *      ),
 *     )
 */

    public function index()
    {

    }

/**
 * @OA\Post(
 *     path="/api/parented.children",
 *     summary="Adds a new user",
 *     tags={"USERS"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              required={"age", "parented_id"},
 *                 @OA\Property(
 *                     property="age",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="parented_id",
 *                     type="integer",
 *                 )
 *             )
 *         )
 *     ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in UserController.store",
 *     )
 * )
 */

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
