<?php

namespace App\Http\Controllers\Areas;

use App\Domains\Areas\Repositories\AreaRepository;
use App\Http\Requests\Areas\UpdateAreaRequest;
use App\Http\Resources\Areas\AreaResource;
use App\Support\Http\Controllers\UserUpdateController;

class AreaUpdateController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"areas"},
     *   path="/areas/{area_id}",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create area",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateAreaRequest")
     *       )
     *   ),
     *   @OA\Parameter(
     *     name="area_id",
     *     in="path",
     *     description="area id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Update area",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/AreaResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível atualizar a área"
     *   )
     * )
     */
    public function __invoke(string $areaId, UpdateAreaRequest $request, AreaRepository $repository)
    {
        return $this->_update($areaId, $request->validated(), $repository, AreaResource::class, 'Não foi possível atualizar a área');
    }
}
