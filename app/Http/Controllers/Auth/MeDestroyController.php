<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Users\Repositories\UserRepository;
use App\Support\Http\Controllers\UserDestroyController;

class MeDestroyController extends UserDestroyController
{
   
    public function __invoke($user_id, UserRepository $repository)
    {
        return $this->_destroy($user_id, $repository, 'Não foi possível excluir o usuário');
    }
}
