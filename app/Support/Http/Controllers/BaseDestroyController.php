<?php

namespace App\Support\Http\Controllers;

use  Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class BaseDestroyController extends BaseController
{
    public function _destroy(Model $model, $serviceRepository, string $errorMessage)
    {
        $deleted = $serviceRepository->delete($model);

        if (!$deleted) {
            return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
        }

        return response()->json(['data' => ['count' => $deleted]]);
    }
}
