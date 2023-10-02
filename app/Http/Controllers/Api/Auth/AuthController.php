<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = new User();
        $role = Role::where('code', $request->role_code)->first();

        try {
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->patronymic = $request->patronymic;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $role->id;
            $user->password = Hash::make($request->password);

            $user->save();

            Auth::login($user);

            $user->registrationAs(Auth::user(), $request);

            $token = $user->createToken('user_token')->plainTextToken;
            $userData = UserResource::collection(User::where('id', $user->id)->with('role')->get());

            return response()->json([ 'userData' => json_decode(json_encode((object) $userData[0]), FALSE), 'token' => $token ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ], 400);
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json('Cridentials not match', 401);
        }

        /** @var User $user */
        $user = $request->user();
        $userData = UserResource::collection(User::where('id', $user->id)->with('role')->get());

        $token = $user->createToken('api')->plainTextToken;

        return response()->json(['userData' => json_decode(json_encode((object) $userData[0]), FALSE),'token' => $token]);
    }
}
