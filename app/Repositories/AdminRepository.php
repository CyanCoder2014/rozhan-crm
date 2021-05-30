<?php

namespace App\Repositories;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class AdminRepository
{
    public function getModel(): Model
    {
        return new Admin();
    }

    public function list()
    {
        return $this->getModel()->select('id', 'full_name', 'email')->get();
    }
}
