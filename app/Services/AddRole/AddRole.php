<?php

namespace App\Services\AddRole;


use App\Services\AddRole\ValueObjects\AddRoleValueObject;

class AddRole
{
    /**
     * @var AddRoleFactory
     */
    protected $factory;

    public function __construct(AddRoleFactory $factory)
    {
        $this->factory = $factory;
    }

    public function perform(AddRoleValueObject $valueObject): void
    {
        $role = $this->factory->getRole();

        $role->name = $valueObject->getName();
        $role->display_name = $valueObject->getDisplayName();
        $role->description = $valueObject->getDescription();

        $role->save();
    }
}
