<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserByTokenRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Children;
use App\Models\Consultant;
use App\Models\Parented;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    public function index(): JsonResource
    {
        return UserResource::collection(User::with('role')->get());
    }

    public function show(int $id): JsonResource
    {
        return UserResource::collection(User::with('role')->where('id', Auth::user()->id)->get());
    }

    public function update(UserUpdateRequest $request, int $id, FilesHandler $filesHandler): JsonResponse
    {
        //TODO: рефакторинг
        $user = User::where('id', Auth::user()->id)->first();
        $consultant = Consultant::where('user_id', $user->id)->first();
        $parented = Parented::where('user_id', $user->id)->first();

        try {
            $user->first_name = $request->firstName;
            $user->second_name = $request->secondName;
            $user->patronymic = $request->patronymic;
            $user->email = $request->email;
            $user->phone = $request->phone;

            $user->save();


            if ($consultant) {
                $consultant->description = $request->description;
                $consultant->specialization_id = $request->specializationId;
                $consultant->profession_id = $request->professionId;

                $consultant->save();
            } else {

                $parented->region_id = $request->regionId;
                $parented->save();

                foreach ($request->childrens as $children) {
                    if (isset($children['id'])) {
                        if ($children['age'] >= 18) {
                            return response()->json([
                                'error' => 'The child\'s age is not suitable for adding'
                            ], 300);
                        }

                        $child = Children::find($children['id']);
                        $child->age = $children['age'];
                        $child->save();
                    } else {

                        if (
                            $children['age'] >= 18 ||
                            count(Children::where('parented_id', $parented->id)->get()) >= Parented::MAX_QUANTITY_CHILDRENS
                        ) {
                            return response()->json([
                                'error' => 'The child\'s age is not suitable for adding, or the number of added children is more than six'
                            ], 300);
                        }
                        $child = new Children();
                        $child->parented_id = $parented->id;
                        $child->age = $children['age'];
                        $child->save();
                    }
                }
            }

            return response()->json([
                'message' => 'User data successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
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

    public function getUserByToken()
    {
        $user = auth('sanctum')->user();

        $userData = UserResource::collection(User::where('id', $user->id)->with('role')->get());

        return response()->json(['userData' => json_decode(json_encode((object) $userData[0]), FALSE)]);
    }
}
