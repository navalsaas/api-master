<?php

namespace App\Http\Controllers\Areas;

use App\Domains\Areas\Repositories\AreaRepository;
use App\Http\Resources\Areas\AreaResource;
use App\Support\Http\Controllers\UserIndexController;
use Illuminate\Http\Request;

class AreaIndexController extends UserIndexController
{
    /**
     * @OA\Get(
     *   tags={"areas"},
     *   path="/areas",
     *   summary="List of areas",
     *   @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/AreaResource")))
     *   ),
     *   security={{
     *       "bearer":{}
     *    }},
     * )
     */
    public function __invoke(Request $request, AreaRepository $repository)
    {
        return $this->_index($request->all(), $repository, AreaResource::class);
    }
}
