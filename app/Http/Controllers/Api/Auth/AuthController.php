<?php

namespace App\Http\Controllers\Api\Auth;

use App\BusinessProcesses\SendingMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $role = Role::where('code', $request->roleCode)->first();

        try {
            $user = User::create([
                'first_name' => $request->firstName,
                'second_name' => $request->secondName,
                'patronymic' => $request->patronymic,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $role->id,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            $user->registrationAs(Auth::user(), $request);

            $token = $user->createToken('user_token')->plainTextToken;
            $userData = UserResource::collection(User::where('id', $user->id)->with('role')->get());

            SendingMail::newUser($user);

            return response()->json(['userData' => json_decode(json_encode((object) $userData[0]), false), 'token' => $token]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in AuthController.register'
            ], 400);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json('Credentials not match', 401);
        }

        $user = $request->user();
        $userData = UserResource::collection(User::where('id', $user->id)->with('role')->get());

        $token = $user->createToken('api')->plainTextToken;

        return response()->json(['userData' => json_decode(json_encode((object) $userData[0]), false), 'token' => $token]);
    }

    public function logout(Request $request)
    {
        try {
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);
            if (!$token) {
                return response()->json('Successful logout');
            }
            $token->delete();

            return response()->json('Successful logout');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in AuthController.register'
            ], 400);
        }
    }

    public function sendToken(NewPasswordRequest $request)
    {
        $token = Str::random(64);

        try {
            User::where('email', $request->email)->get()->firstOrFail();
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } catch (Exception $e) {
            return response()->json('This email is not registered or the token has already been received at the specified email', 400);
        }

        Mail::send('resetPassword', ['url' => env('APP_URL') . '/resetPassword/' . $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Сброс пароля');
        });

        return response()->json('Data send success');
    }

    public function resetPassword(UpdatePasswordRequest $request): JsonResponse
    {
        try {
            $token = DB::table('password_reset_tokens')->where('token', $request->resetToken)->get()->firstOrFail();
        } catch (Exception $e) {
            return response()->json('This email is not registered or the token is expired', 400);
        }

        $user = User::where('email', $token->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where(['token' => $request->resetToken])->delete();

        return response()->json('Password updated success');
    }
}
