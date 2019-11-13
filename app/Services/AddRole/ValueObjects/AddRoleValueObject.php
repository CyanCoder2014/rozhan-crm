<?php

namespace App\Services\AddRole\ValueObjects;


use Illuminate\Support\Str;

class AddRoleValueObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AddRoleValueObject
     */
    public function setName(string $name): AddRoleValueObject
    {
        $this->name = Str::camel($name);
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return AddRoleValueObject
     */
    public function setDisplayName(string $displayName = null): AddRoleValueObject
    {
        $this->displayName = $displayName ?? $this->name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return AddRoleValueObject
     */
    public function setDescription(string $description = null): AddRoleValueObject
    {
        $this->description = $description ?? $this->name;
        return $this;
    }
}
