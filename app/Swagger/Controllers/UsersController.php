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
 *     path="/api/users",
 *     summary="Adds a new user",
 *     tags={"USERS"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              required={"first_name", "second_name", "patronymic", "email","phone","password","role_id"},
 *                 @OA\Property(
 *                     property="first_name",
 *                     type="string",
 *                     maxLength=255
 *                 ),
 *                 @OA\Property(
 *                     property="second_name",
 *                     type="string",
 *                     maxLength=255
 *                 ),
 *                 @OA\Property(
 *                     property="patronymic",
 *                     type="string",
 *                     maxLength=255
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     uniqueItems=true,
 *                     maxLength=255
 *                 ),
 *                 @OA\Property(
 *                     property="phone",
 *                     type="string",
 *                     uniqueItems=true,
 *                     maxLength=255
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                     maxLength=255,
 *                     minLength=6
 *                 ),
 *                 @OA\Property(
 *                     property="role_code",
 *                     type="string",
 *                 ),
 *
 *                 example={"first_name": "Иван",
 *                          "second_name": "Иванов",
 *                          "patronymic": "Иванович",
 *                          "email": "ivan@gmail.ru",
 *                          "phone": "+7 (999) 999 9999",
 *                          "password": "834jhvasdf&",
 *                          "role_code": "consultant",
 *                          }
 *             )
 *         )
 *     ),
 *
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
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in UserController.store",
 *     )
 * )
 */


    public function store($request)
    {

    }

    public function show(string $id)
    {

    }

    public function update($request, string $id)
    {

    }


    public function destroy(string $id)
    {

    }
/**
 * @OA\Post(
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

