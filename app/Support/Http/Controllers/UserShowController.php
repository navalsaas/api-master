<?php

namespace App\Support\Http\Controllers;

use Illuminate\Http\Response;

class UserShowController extends BaseController
{
    /**
     * Show item.
     *
     * @param [Service/Repository] $serviceRepository
     *
     * @return void
     */
    public function _show(string $id, $serviceRepository, string $resource, string $errorMessage)
    {
        $item = $serviceRepository
            ->setUserId(auth()->id())
            ->findById($id);

        if ($item) {
            return new $resource($item);
        }

        return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
    }
}
