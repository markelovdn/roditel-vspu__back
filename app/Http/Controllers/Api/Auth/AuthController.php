<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(StoreUserRequest $request)
    {
        $user = new User();

        try {

            $user->firstname = $request->firstname;
            $user->secondname = $request->secondname;
            $user->patronymic = $request->patronymic;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;
            $user->password = Hash::make($request->password);

            $user->save();

            $role = Role::where('id', $request->role_id)->first();

            Auth::login($user);

            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([ 'user' => $user, 'role' => $role, 'token' => $token ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ], 400);
        }
    }

    public function login(Request $request)
    {
        // С бэка нужно, чтобы приходило на фронт firstName, secondName, surName и fullName как раз, как комбинация всех сразу

        try {
            $user = User::where('email', '=', $request->input('email'))->firstOrFail();

            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([ 'user' => $user, 'access_token' => $token ], 200);
            }

            return response()->json([
                'error' => [
                    'type' => 'password',
                    'message' => 'Не верный пароль']
                ], 400);

        } catch (\Exception $e) {
            return response()->json([
                // 'error' => $e->getMessage(),
                'error' => [
                    'type' => 'phone',
                    'message' => 'Не верный номер телефона']
            ], 400);
        }
    }
}
