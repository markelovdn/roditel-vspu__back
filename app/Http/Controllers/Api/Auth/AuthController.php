<?php

namespace App\Http\Controllers\Api\Auth;

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
use Laravel\Sanctum\PersonalAccessToken;

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

            return response()->json(['userData' => json_decode(json_encode((object) $userData[0]), false), 'token' => $token], 200);
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
            return response()->json('Credentials not match', 401);
        }

        /** @var User $user */
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
            $token->delete();

            return response()->json('Successful logout', 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ], 400);
        }
    }

    public function sendToken (NewPasswordRequest $request)
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

        Mail::send('mail', ['url' => env('APP_URL').'/api/resetPasword/'.$token], function ($message) use($request) {
            $message->to($request->email);
            $message->subject('Сброс пароля');
        });

        return response()->json('Data send success', 200);
    }

    public function resetPassword(UpdatePasswordRequest $request): JsonResponse
    {
        //TODO:переработать
        // $token = explode('/', $_SERVER['REQUEST_URI'])[3];
        try {
            DB::table('password_reset_tokens')->where('token', $request->token)->get()->firstOrFail();

        } catch (Exception $e) {
            return response()->json('This email is not registered or the token is expired', 401);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where(['token' => $request->token])->delete();

        return response()->json('Password updated success', 200);
    }
}
