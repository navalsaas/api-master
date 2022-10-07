<?php

namespace App\Http\Requests\Tasks;

use App\Support\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema()
 */
class UpdateTaskRequest extends Request
{
    /**
     * @OA\Property(property="area_id", type="string")
     * @OA\Property(property="name", type="string")
     * @OA\Property(property="days", type="string")
     * @OA\Property(property="order", type="number")
     *
     * @return void
     */
    public function rules()
    {
        $userId = auth()->id();

        return [
            'area_id' => [
                'sometimes',
                Rule::exists('areas', 'id')
                    ->where('user_id', $userId)
                    ->whereNull('deleted_at'),
            ],
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'days' => [
                'sometimes',
                'array',
            ],
            'order' => [
                'sometimes',
                'integer',
            ],
        ];
    }
}
