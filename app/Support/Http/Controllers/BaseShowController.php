<?php

namespace App\Support\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Http\Response;

class BaseShowController extends BaseController
{
    /**
     * Show item.
     *
     * @param [Service/Repository] $serviceRepository
     *
     * @return void
     */
    public function _show(Model $model, $serviceRepository, string $resource, string $errorMessage)
    {
        $item = $serviceRepository
            ->findById($model->id);

        if ($item) {
            return new $resource($item);
        }

        return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
    }
}
