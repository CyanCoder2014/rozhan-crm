<?php

namespace App\Services\CreateCooperationAccount;

use App\CooperationAccount;

class CreateCooperationAccount
{
    /**
     * @var CreateCooperationAccountFactory
     */
    protected $factory;

    public function __construct(CreateCooperationAccountFactory $factory)
    {
        $this->factory = $factory;
    }

    public function perform(string $name, int $userId): CooperationAccount
    {
        $cooperationAccount = $this->factory->getCooperationAccount();

        $cooperationAccount = $cooperationAccount::create([
            'name'       => $name,
            'created_by' => $userId,
            'status'     => 1
        ]);

        return $cooperationAccount;
    }
}
