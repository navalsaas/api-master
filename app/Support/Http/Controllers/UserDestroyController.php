<?php

namespace App\Support\Http\Controllers;

use Illuminate\Http\Response;

class UserDestroyController extends BaseController
{
    /**
     * Undocumented function.
     *
     * @param [Service/Repository] $serviceRepository
     * @param mixed                $id
     *
     * @return void
     */
    public function _destroy(string $id, $serviceRepository, string $errorMessage)
    {
        $serviceRepository = $serviceRepository->setUserId(auth()->id());
        $model = $serviceRepository->findById($id);

        if (!$model) {
            return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
        }

        $deleted = $serviceRepository
            ->setUserId(auth()->id())
            ->delete($model);

        if (!$deleted) {
            return response()->json(['message' => $errorMessage, 'code' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
        }

        return response()->json(['data' => ['count' => $deleted]]);
    }
}
