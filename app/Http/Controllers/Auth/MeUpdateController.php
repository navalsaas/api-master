<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Users\Repositories\UserRepository;
use App\Http\Requests\Auth\UserUpdateRequest;
use App\Http\Resources\Auth\UserResource;
use App\Support\Http\Controllers\BaseController;
use Illuminate\Http\Response;

class MeUpdateController extends BaseController
{
    /**
     * @OA\Put(
     *   tags={"auth"},
     *   path="/auth/me",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Update User",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UserUpdateRequest")
     *       )
     *   ),
     *   summary="Update User Auth me",
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
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="Falha na atualização do usuário"
     *   )
     * )
     */
    public function __invoke(UserUpdateRequest $request, UserRepository $repository)
    {
        $user = $request->user();
        $updated = $repository->update($user, $request->validated());

        if (!$updated) {
            return response()->json(['message' => 'Falha na atualização do usuário', 'code' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(200);
    }
}
