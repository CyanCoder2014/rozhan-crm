<?php

namespace App\Services\AddAdmin;

use App\Services\AddAdmin\ValueObjects\AddAdminValueObject;
use Illuminate\Support\Facades\Hash;

class AddAdminService
{
    /**
     * @var AddAdminFactory
     */
    protected $factory;

    public function __construct(AddAdminFactory $factory)
    {
        $this->factory = $factory;
    }

    public function perform(AddAdminValueObject $valueObject)
    {
        $admin = $this->factory->getAdmin();

        $admin->full_name = $valueObject->getFullName();
        $admin->email     = $valueObject->getEmail();
        $admin->password  = Hash::make($valueObject->getPassword());

        $admin->save();
    }
}
