<?php

namespace App\Support\Domain\Repositories;

abstract class UserRepository extends Repository
{
    /**
     * @var bool
     */
    protected $userOnly = true;
}
