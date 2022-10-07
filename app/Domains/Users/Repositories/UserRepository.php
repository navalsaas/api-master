<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Users\User;
use App\Support\Domain\Repositories\Repository;

class UserRepository extends Repository
{
    protected $modelClass = User::class;

    protected $allowedFilters = [
        'name',
        'email',
    ];

    protected $defaultSort = 'name';

    public function updatePassword(User $user, $password)
    {
        $user->password = $password;

        return $user->save();
    }
}
