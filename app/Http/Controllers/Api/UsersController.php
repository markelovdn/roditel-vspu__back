<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        return UserResource::collection(User::with('role')->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();

        try {
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->patronymic = $request->patronymic;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;
            $user->password = Hash::make($request->password);

            $user->save();

            $role = Role::where('id', $request->role_id)->first();

            return response()->json([ 'user' => $user, 'role' => $role ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ], 400);
        }
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
