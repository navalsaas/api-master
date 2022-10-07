<?php

namespace App\Http\Controllers\GratitudeDiaries;

use App\Domains\GratitudeDiaries\Repositories\GratitudeDiaryRepository;
use App\Support\Http\Controllers\UserDestroyController;

class GratitudeDiaryDestroyController extends UserDestroyController
{
    /**
     * @OA\Delete(
     *   tags={"gratitude-diaries"},
     *   path="/gratitude-diaries/{gratitude_diary_id}",
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
     *   summary="Delete gratitude_diary",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="403",
     *     description="Não foi possível excluir a gratidão diária"
     *   )
     * )
     */
    public function __invoke(string $gratitude_diaryId, GratitudeDiaryRepository $repository)
    {
        return $this->_destroy($gratitude_diaryId, $repository, 'Não foi possível excluir a gratidão diária');
    }
}
