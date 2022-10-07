<?php

namespace App\Http\Controllers\GratitudeDiaries;

use App\Domains\GratitudeDiaries\Repositories\GratitudeDiaryRepository;
use App\Http\Resources\GratitudeDiaries\GratitudeDiaryResource;
use App\Support\Http\Controllers\UserShowController;

class GratitudeDiaryShowController extends UserShowController
{
    /**
     * @OA\Get(
     *   tags={"gratitude-diaries"},
     *   path="/gratitude-diaries/{gratitude_diary_id}",
     *   @OA\Parameter(
     *     name="gratitudediary_id",
     *     in="path",
     *     description="gratitude diary id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Get gratitude_diary from id",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/GratitudeDiaryResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="404",
     *     description="Não foi possível encontrar a gratidão diária"
     *   )
     * )
     */
    public function __invoke(string $gratitude_diaryId, GratitudeDiaryRepository $repository)
    {
        return $this->_show($gratitude_diaryId, $repository, GratitudeDiaryResource::class, 'Não foi possível encontrar a gratidão diária');
    }
}
