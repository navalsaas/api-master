<?php

namespace App\Support\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Http\Response;

class BaseUpdateController extends BaseController
{
    /**
     * Update item.
     *
     * @param [Service/Repository] $serviceRepository
     *
     * @return void
     */
    public function _update(Model $model, array $data, $serviceRepository, string $resource, string $errorMessage)
    {
        $updated = $serviceRepository->update($model, $data);

        if ($updated) {
            return new $resource($model);
        }

        return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
