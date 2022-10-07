<?php

namespace App\Http\Controllers\Areas;

use App\Domains\Areas\Repositories\AreaRepository;
use App\Support\Http\Controllers\UserDestroyController;

class AreaDestroyController extends UserDestroyController
{
    /**
     * @OA\Delete(
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
     *   summary="Delete area",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível excluir a área"
     *   )
     * )
     */
    public function __invoke(string $areaId, AreaRepository $repository)
    {
        return $this->_destroy($areaId, $repository, 'Não foi possível excluir a área');
    }
}
