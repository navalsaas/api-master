<?php

namespace App\Http\Controllers\Areas;

use App\Domains\Areas\Repositories\AreaRepository;
use App\Http\Resources\Areas\AreaResource;
use App\Support\Http\Controllers\UserShowController;

class AreaShowController extends UserShowController
{
    /**
     * @OA\Get(
     *   tags={"areas"},
     *   path="/areas/{area_id}",
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
     *   summary="Get area from id",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/AreaResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="404",
     *     description="Não foi possível encontrar a área"
     *   )
     * )
     */
    public function __invoke(string $areaId, AreaRepository $repository)
    {
        return $this->_show($areaId, $repository, AreaResource::class, 'Não foi possível encontrar a área');
    }
}
