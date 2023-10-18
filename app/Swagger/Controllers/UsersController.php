<?php

namespace App\Swagger\Controllers;

class UsersController
{
/**
 * @OA\Get(
 *      path="/api/users",
 *      operationId="getUsersList",
 *      tags={"USERS"},
 *      summary="Get list of users",
 *      description="Returns list of users",
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *         oneOf={
 *              @OA\Schema(
 *                  schema="User response",
 *                  title="Sample schema users list",
 *                  @OA\Property(
 * 		                property="userData",
 * 		                type="object",
 *                          @OA\Property(
 * 		                        property="firstName",
 * 		                        type="string"
 * 	                            ),
 * 	                        @OA\Property(
 * 		                        property="secondName",
 * 		                        type="string"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="patronymic",
 * 		                        type="string"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="email",
 * 		                        type="string"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="phone",
 * 		                        type="string"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="password",
 * 		                        type="string"
 * 	                            ),
 *                          @OA\Property(
 * 		                        property="role",
 * 		                        type="object",
 *                                  @OA\Property(
 * 		                            property="id",
 * 		                            type="integer"
 * 	                                ),
 *                                  @OA\Property(
 * 		                            property="code",
 * 		                            type="string"
 * 	                                ),
 *                                  @OA\Property(
 * 		                            property="title",
 * 		                            type="string"
 * 	                                )
 * 	                        )
 * 	                    ),
 * 	                )
 *        },
 *
 *        )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Permissions denied",
 *      ),
 *     )
 */
    public function index()
    {

    }

/**
 * @OA\Get(
 *      path="/api/users/{id}",
 *      operationId="showUser",
 *      tags={"USERS"},
 *      summary="Show user",
 *      description="Returns user",
 *      @OA\Parameter(
 *         description="integer, id user",
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

    public function show(string $id)
    {

    }

/**
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Update user",
 *     tags={"USERS"},
 *     @OA\Parameter(
 *         description="integer, id user",
 *         in="query",
 *         name="",
 *         required=true
 *         ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="first_name",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="second_name",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="patronymic",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255, uniqueItems=true",
 *         in="path",
 *         name="email",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255, uniqueItems=true",
 *         in="path",
 *         name="phone",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="password",
 *         required=true,
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *      ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in UserController.update",
 *     )
 * )
 */

    public function update($request, string $id)
    {

    }

/**
 * @OA\Delete(
 *      path="/api/users/{id}",
 *      operationId="deleteUser",
 *      tags={"USERS"},
 *      summary="Delete user",
 *      @OA\Parameter(
 *         description="integer, id user",
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

    public function destroy(string $id)
    {

    }
/**
 * @OA\Get(
 *     path="/api/getUserByToken",
 *     summary="Get user by token",
 *     tags={"USERS"},
 *     @OA\Parameter(
 *         description="string",
 *         in="header",
 *         name="token",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in UserController.getUserByToken",
 *     )
 * )
 */
    public function getUserByToken()
    {}
}

