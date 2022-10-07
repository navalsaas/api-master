<?php

namespace App\Support\Http\Controllers;

use Illuminate\Http\Response;

class BaseStoreController extends BaseController
{
    /**
     * Create new item.
     *
     * @param [Service/Repository] $serviceRepository
     *
     * @return void
     */
    public function _store(array $data, $serviceRepository, string $resource, string $errorMessage)
    {
        $item = $serviceRepository->create($data);

        if ($item) {
            return new $resource($item);
        }

        return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
