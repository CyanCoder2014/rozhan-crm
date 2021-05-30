<?php

namespace App\Services\AddAdmin\ValueObjects;

class AddAdminValueObject
{
    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return AddAdminValueObject
     */
    public function setFullName(string $fullName): AddAdminValueObject
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AddAdminValueObject
     */
    public function setEmail(string $email): AddAdminValueObject
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return AddAdminValueObject
     */
    public function setPassword(string $password): AddAdminValueObject
    {
        $this->password = $password;
        return $this;
    }
}
