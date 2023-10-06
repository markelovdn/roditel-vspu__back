<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserByTokenRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UsersController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::with('role')->get());
    }

    public function store(StoreUserRequest $request): JsonResource
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

            return UserResource::collection(User::where('id', $user->id)->with('role')->get());

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.store'
            ], 400);
        }
    }

    public function show(string $id)
    {
        return UserResource::collection(User::with('role')->where('id', $id)->get());
    }

    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();
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

            return UserResource::collection(User::where('id', $user->id)->with('role')->get());

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.update'
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            User::destroy($id);
            return response()->json([
                'message' => 'Record successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.destroy'
            ], 400);
        }
    }

    public function getUserByToken() {
        $user = auth('sanctum')->user();

        $userData = UserResource::collection(User::where('id', $user->id)->with('role')->get());

        return response()->json(['userData' => json_decode(json_encode((object) $userData[0]), FALSE)]);

    }
}
