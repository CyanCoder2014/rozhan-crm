<?php

namespace App\Services\CreateCooperationAccount;

use App\CooperationAccount;

class CreateCooperationAccountFactory
{
    public function getCooperationAccount(): CooperationAccount
    {
        return new CooperationAccount();
    }
}
