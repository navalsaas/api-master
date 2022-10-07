<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Users\Repositories\UserRepository;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Resources\MessageResource;
use App\Support\Http\Controllers\BaseController;
use Illuminate\Http\Response;

class MeUpdatePasswordController extends BaseController
{
    /**
     * @OA\Put(
     *   tags={"auth"},
     *   path="/auth/password",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Update password",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdatePasswordRequest")
     *       )
     *   ),
     *   summary="Update Password to User",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/MessageResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Forbiden"
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="Falha na atualização do usuário"
     *   )
     * )
     */
    public function __invoke(UpdatePasswordRequest $request, UserRepository $repository)
    {
        $user = $request->user();
        $updated = $repository->updatePassword($user, $request->input('password'));

        if (!$updated) {
            return response()->json(['message' => 'Falha na atualização da senha', 'code' => Response::HTTP_INTERNAL_SERVER_ERROR], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new MessageResource((object) ['message' => 'Senha atualizada com sucesso!']))
            ->response()
            ->setStatusCode(200);
    }
}
