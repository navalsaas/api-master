<?php

namespace App\Http\Controllers\GratitudeDiaries;

use App\Domains\GratitudeDiaries\Repositories\GratitudeDiaryRepository;
use App\Http\Requests\GratitudeDiaries\UpdateGratitudeDiaryRequest;
use App\Http\Resources\GratitudeDiaries\GratitudeDiaryResource;
use App\Support\Http\Controllers\UserUpdateController;

class GratitudeDiaryUpdateController extends UserUpdateController
{
    /**
     * @OA\Put(
     *   tags={"gratitude-diaries"},
     *   path="/gratitude-diaries/{gratitude_diary_id}",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create gratitude diary",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UpdateGratitudeDiaryRequest")
     *       )
     *   ),
     *   @OA\Parameter(
     *     name="gratitude_diary_id",
     *     in="path",
     *     description="gratitude_diary id",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         format="uuid"
     *     )
     *   ),
     *   summary="Update gratitude_diary",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/GratitudeDiaryResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível atualizar a gratidão diária"
     *   )
     * )
     */
    public function __invoke(string $gratitude_diaryId, UpdateGratitudeDiaryRequest $request, GratitudeDiaryRepository $repository)
    {
        return $this->_update($gratitude_diaryId, $request->validated(), $repository, GratitudeDiaryResource::class, 'Não foi possível atualizar a gratidão diária');
    }
}
