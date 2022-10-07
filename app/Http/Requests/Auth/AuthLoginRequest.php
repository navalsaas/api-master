<?php

namespace App\Http\Requests\Auth;

use App\Support\Http\Request;

/**
 * @OA\Schema(
 * required={"email", "password"}
 * )
 */
class AuthLoginRequest extends Request
{
    /**
     * @OA\Property(property="email", type="string", description="Email", format="email", example="emtudo@gmail.com")
     * @OA\Property(property="password", type="string", description="Senha", format="password")
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ];
    }
}
