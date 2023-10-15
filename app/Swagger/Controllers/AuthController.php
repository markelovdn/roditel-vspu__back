<?php

namespace App\Swagger\Controllers;

class AuthController
{

/**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Registration new user",
 *     tags={"AUTH"},
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="first_name",
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
 *     @OA\Parameter(
 *         description="consultant or parented",
 *         in="path",
 *         name="role_code",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer, only for consultant role",
 *         in="path",
 *         name="specialization_id",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer, only for consultant role",
 *         in="path",
 *         name="profession_id",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="integer, only for parented role",
 *         in="path",
 *         name="region_id",
 *         required=true,
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              required={"first_name", "second_name", "patronymic", "email","phone","password","role_code", "specialization_id", "profession_id"},
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
 *                 @OA\Property(
 *                     property="specialization_id",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="profession_id",
 *                     type="integer",
 *                 ),
 *                 @OA\Examples(example="result1", value={"first_name": "Иван",
 *                          "second_name": "Иванов",
 *                          "patronymic": "Иванович",
 *                          "email": "ivan@gmail.ru",
 *                          "phone": "+7 (999) 999 9999",
 *                          "password": "834jhvasdf&",
 *                          "role_code": "consultant",
 *                          "specialization_id": 1,
 *                          "profession_id": 1,
 *                          }, summary="An result object1."),
 *
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
 * 	                            )
 * 	                  ),
 * 	                )
 *        },
 *
 *        )
 *      ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in AuthController.register",
 *     )
 * )
 */


    public function register()
    {

    }

/**
 * @OA\Post(
 *     path="/api/login",
 *     summary="Auth user as",
 *     tags={"AUTH"},
 *     @OA\Parameter(
 *         description="string, maxLength=255, uniqueItems=true",
 *         in="path",
 *         name="email",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string, maxLength=255",
 *         in="path",
 *         name="password",
 *         required=true,
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              required={"email","password"},
 *                 @OA\Property(
 *                     property="email",
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
 *                 @OA\Examples(example="result1", value={"first_name": "Иван",
 *                          "email": "ivan@gmail.ru",
 *                          "password": "834jhvasdf&",
 *                          }, summary="An result object1."),
 *
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
 * 	                            )
 * 	                  ),
 * 	                )
 *        },
 *
 *        )
 *      ),
 *
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in AuthController.register",
 *     )
 * )
 */
    public function login()
    {

    }

/**
 * @OA\Post(
 *     path="/api/logout",
 *     summary="Logout user",
 *     tags={"AUTH"},
 *     @OA\Parameter(
 *         description="string",
 *         in="header",
 *         name="token",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=200,
 *         description="Successful logout",
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="Something went wrong in AuthController.logout",
 *     )
 * )
 */

    public function logout () {}

    /**
 * @OA\Post(
 *     path="/api/forgotPassword",
 *     summary="Sending a link to reset your password",
 *     tags={"AUTH"},
 *     @OA\Parameter(
 *         description="string, email",
 *         in="path",
 *         name="email",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=200,
 *         description="Data send success",
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="This email is not registered or the token has already been received at the specified email",
 *     )
 * )
 */

    public function sendToken () {}

    /**
 * @OA\Post(
 *     path="/api/resetPassword/{token}",
 *     summary="Set new password",
 *     tags={"AUTH"},
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="password",
 *         required=true,
 *     ),
 *     @OA\Parameter(
 *         description="string",
 *         in="path",
 *         name="token",
 *         required=true,
 *     ),
 *      @OA\Response(
 *         response=200,
 *         description="Password updated success",
 *     ),
 *      @OA\Response(
 *         response=400,
 *         description="This email is not registered or the token is expired",
 *     )
 * )
 */

    public function resetPassword() {}

}
