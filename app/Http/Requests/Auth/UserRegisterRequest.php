<?php

namespace App\Http\Requests\Auth;

use App\Support\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 * required={"name","email","password"}
 * )
 */
class UserRegisterRequest extends Request
{
    protected $errorMessage = 'Dados para criar usuário são inválidos';

    /**
     * @OA\Property(property="name",type="string", description="Nome")
     * @OA\Property(property="email", type="string", description="Email", format="email")
     * @OA\Property(property="password", type="string", description="Senha", format="password")
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:60',
            ],
            'last_name' => [
                'required',
                'string',
                'min:3',
                'max:60',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')
                    ->whereNull('deleted_at'),
            ],
            'password' => [
                'required',
                'min:6',
            ],
        ];
    }
}
