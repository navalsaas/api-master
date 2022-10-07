<?php

namespace App\Http\Requests\Auth;

use App\Support\Http\Request;

/**
 * @OA\Schema()
 */
class UserUpdateRequest extends Request
{
    protected $errorMessage = 'Dados para atualizar o usuário são inválidos';

    /**
     * @OA\Property(property="name", type="string", description="Nome")
     */
    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'min:3',
                'max:60',
            ],
       ];
    }
}
