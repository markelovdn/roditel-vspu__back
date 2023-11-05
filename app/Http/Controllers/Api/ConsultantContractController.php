<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantContractRequest;
use App\Models\Contract;
use App\Http\Resources\ConsultantsContractResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantContractController extends Controller
{
    public function index()
    {
        return ConsultantsContractResource::collection(Contract::get());
    }

    public function store(StoreConsultantContractRequest $request)
    {
        $contract = Contract::create($request->validated());
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
