<?php

namespace App\Http\Controllers\Areas;

use App\Domains\Areas\Repositories\AreaRepository;
use App\Http\Requests\Areas\CreateAreaRequest;
use App\Http\Resources\Areas\AreaResource;
use App\Support\Http\Controllers\UserStoreController;

class AreaStoreController extends UserStoreController
{
    /**
     * @OA\Post(
     *   tags={"areas"},
     *   path="/areas",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create area",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateAreaRequest")
     *       )
     *   ),
     *   summary="Create area",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/AreaResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="304",
     *     description="Falha ao criar área"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */
    public function __invoke(CreateAreaRequest $request, AreaRepository $repository)
    {
        return $this->_store($request->validated(), $repository, AreaResource::class, 'Falha ao criar área');
    }
}
