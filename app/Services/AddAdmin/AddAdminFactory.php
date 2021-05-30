<?php

namespace App\Services\AddAdmin;

use App\Admin;

class AddAdminFactory
{
    public function getAdmin(): Admin
    {
        return new Admin();
    }
}
