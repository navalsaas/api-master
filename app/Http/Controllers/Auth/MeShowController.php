<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\Auth\UserResource;
use App\Support\Http\Controllers\BaseController;

class MeShowController extends BaseController
{
    /**
     * @OA\Get(
     *   tags={"auth"},
     *   path="/auth/me",
     *   summary="Auth me",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/UserResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="401",
     *     description="Unauthorized"
     *   )
     * )
     */
    public function __invoke()
    {
        return (UserResource::make(auth()->user()))
            ->response()
            ->setStatusCode(200);
    }
}
