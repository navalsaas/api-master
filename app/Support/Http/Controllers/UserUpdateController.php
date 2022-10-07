<?php

namespace App\Support\Http\Controllers;

use Illuminate\Http\Response;

class UserUpdateController extends BaseController
{
    /**
     * Update item.
     *
     * @param [Service/Repository] $serviceRepository
     *
     * @return void
     */
    public function _update(string $id, array $data, $serviceRepository, string $resource, string $errorMessage)
    {
        $serviceRepository = $serviceRepository
            ->setUserId(auth()->id());

        $item = $serviceRepository
            ->findById($id);

        if (!$item) {
            return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        }

        $updated = $serviceRepository
            ->update($item, $data);

        if (!$updated) {
            return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new $resource($item);
    }
}
