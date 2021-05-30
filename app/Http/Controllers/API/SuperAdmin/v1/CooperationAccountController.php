<?php

namespace App\Http\Controllers\API\SuperAdmin\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\CooperationAccount\UpdateRequest;
use App\Repositories\CooperationAccountRepository;
use App\Services\UpdateCooperationAccount\UpdateCooperationAccountService;

class CooperationAccountController extends Controller
{
    /**
     * @var CooperationAccountRepository
     */
    protected $cooperationAccountRepository;

    public function __construct(CooperationAccountRepository $cooperationAccountRepository)
    {
        $this->cooperationAccountRepository = $cooperationAccountRepository;
    }

    public function update(int $id, UpdateRequest $request, UpdateCooperationAccountService $updateCooperationAccount)
    {
        $cooperationAccount = $this->cooperationAccountRepository->findOrFail($id);

        $account = $updateCooperationAccount->perform($cooperationAccount, $request->all());

        return response()->json([
            'status' => true,
            'result' => $account
        ]);
    }

    public function list()
    {
        return response()->json([
            'status' => true,
            'result' => $this->cooperationAccountRepository->list()
        ]);
    }
}
