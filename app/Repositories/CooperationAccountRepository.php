<?php

namespace App\Repositories;

use App\CooperationAccount;
use Illuminate\Database\Eloquent\Model;

class CooperationAccountRepository
{
    public function getModel(): Model
    {
        return new CooperationAccount();
    }

    public function findOrFail(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function list()
    {
        return $this->getModel()->all();
    }
}
