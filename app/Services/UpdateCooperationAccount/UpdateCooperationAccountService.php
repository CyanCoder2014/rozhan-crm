<?php

namespace App\Services\UpdateCooperationAccount;

use App\CooperationAccount;
use Carbon\Carbon;

class UpdateCooperationAccountService
{
    public function perform(CooperationAccount $cooperationAccount, array $data): CooperationAccount
    {
        if (isset($data['status'])) {
            $cooperationAccount->status = (int)$data['status'];
        }

        if (isset($data['expired_at'])) {
            $cooperationAccount->expired_at = Carbon::parse($data['expired_at'])->format('Y-m-d H:i:s');
        }

        $cooperationAccount->save();

        return $cooperationAccount;
    }
}
