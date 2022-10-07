<?php

namespace App\Http\Controllers\Goals;

use App\Domains\Goals\Repositories\GoalRepository;
use App\Http\Resources\Goals\GoalResource;
use App\Support\Http\Controllers\UserIndexController;
use Illuminate\Http\Request;

class GoalIndexController extends UserIndexController
{
    /**
     * @OA\Get(
     *   tags={"goals"},
     *   path="/goals",
     *   summary="List of goals",
     *   @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/GoalResource")))
     *   ),
     *   security={{
     *       "bearer":{}
     *    }},
     * )
     */
    public function __invoke(Request $request, GoalRepository $repository)
    {
        return $this->_index($request->all(), $repository, GoalResource::class);
    }
}
