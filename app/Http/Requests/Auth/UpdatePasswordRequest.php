<?php

namespace App\Http\Requests\Auth;

use App\Support\Http\Request;

/**
 * @OA\Schema()
 */
class UpdatePasswordRequest extends Request
{
    protected $errorMessage = 'Dados para atualizar senha não são válidos';

    /**
     * @OA\Property(property="current_password", type="string", description="Senha atual", format="password")
     * @OA\Property(property="password", type="string", description="Nova senha", format="password")
     */
    public function rules()
    {
        return [
            'current_password' => [
                'required',
                'string',
                'max:60',
            ],
            'password' => [
                'required',
                'string',
                'max:60',
            ],
       ];
    }
}
