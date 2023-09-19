<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantRequest;
use App\Http\Resources\ConsultantsResource;
use App\Models\Consultant;
use App\Models\Role;
use Illuminate\Http\Request;

class ConsultantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConsultantsResource::collection(Consultant::with('user', 'specialization', 'profession')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsultantRequest $request, FilesHandler $filesHandler)
    {
        //TODO: сделать проверку на фронте после регистрации в личном кабинете пользователя в роли консультанта, перенаправлять на профиль для заполнения добавить фото и описание себя

        $role = new Role();
        $isConsultant = $role->isConsultant(Auth()->user()->id);

        if(!$isConsultant) {
            return response()->json(['error' => 'Access is denied'], 400);
        }

        $consultant = Consultant::where('user_id', $request->user_id)->first();

        try {
            $consultant->photo = $filesHandler->uploadPhoto($consultant->user_id, $request->photo);
            $consultant->description = $request->description;

            $consultant->save();

            return response()->json([
                'message' => 'Data successfully added'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.store'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
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
