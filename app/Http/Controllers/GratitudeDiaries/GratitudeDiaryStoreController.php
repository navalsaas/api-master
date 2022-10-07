<?php

namespace App\Http\Controllers\GratitudeDiaries;

use App\Domains\GratitudeDiaries\Repositories\GratitudeDiaryRepository;
use App\Http\Requests\GratitudeDiaries\CreateGratitudeDiaryRequest;
use App\Http\Resources\GratitudeDiaries\GratitudeDiaryResource;
use App\Support\Http\Controllers\UserStoreController;

class GratitudeDiaryStoreController extends UserStoreController
{
    /**
     * @OA\Post(
     *   tags={"gratitude-diaries"},
     *   path="/gratitude-diaries",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Create gratitude diary",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/CreateGratitudeDiaryRequest")
     *       )
     *   ),
     *   summary="Create gratitude diary",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/GratitudeDiaryResource")),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="304",
     *     description="Falha ao criar gratidão diária"
     *   ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */
    public function __invoke(CreateGratitudeDiaryRequest $request, GratitudeDiaryRepository $repository)
    {
        $data = $request->validated();
        $data['date'] ?? now()->format('Y-m-d');

        return $this->_store($data, $repository, GratitudeDiaryResource::class, 'Falha ao criar gratidão diária');
    }
}
