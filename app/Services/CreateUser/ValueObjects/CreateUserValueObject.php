<?php

namespace App\Services\CreateUser\ValueObjects;


class CreateUserValueObject
{
    /**
     * @var string
     */
    protected $name;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CreateUserValueObject
     */
    public function setName(string $name): CreateUserValueObject
    {
        $this->name = $name;
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
     * @return CreateUserValueObject
     */
    public function setEmail(string $email): CreateUserValueObject
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
     * @return CreateUserValueObject
     */
    public function setPassword(string $password): CreateUserValueObject
    {
        $this->password = $password;
        return $this;
    }
}
