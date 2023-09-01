<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

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
