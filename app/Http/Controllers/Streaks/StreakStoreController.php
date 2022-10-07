<?php

namespace App\Http\Controllers\Streaks;

use App\Domains\Streaks\Repositories\StreakRepository;
use App\Http\Requests\Streaks\CreateStreakRequest;
use App\Http\Resources\Streaks\StreakResource;
use App\Support\Http\Controllers\UserStoreController;

class StreakStoreController extends UserStoreController
{
    /**
     * @OA\Post(
     *   tags={"streaks"},
     *   path="/streaks",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create streak",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateStreakRequest")
     *       )
     *   ),
     *   summary="Create streak",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/StreakResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="304",
     *     description="Falha ao criar streak"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */
    public function __invoke(CreateStreakRequest $request, StreakRepository $repository)
    {
        $data = $request->validated();

        $data['date_start'] = data_get($data, 'date_start', now()->format('Y-m-d'));

        return $this->_store($data, $repository, StreakResource::class, 'Falha ao criar streak');
    }
}
