<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexResource;
use App\Support\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(title="App core", version="0.1")
 */
/**
 * @OA\SecurityScheme(
 *   securityScheme="bearer",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization",
 *   bearerFormat="JWT"
 * )
 */
class IndexController extends BaseController
{
    /**
     * @OA\Get(
     *   tags={"index"},
     *   path="/",
     *   summary="Index",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="object", ref="#/components/schemas/IndexResource")
     *         ),
     *     ),
     *   security={{
     *     "bearer":{}
     *   }},
     *   @OA\Response(
     *     response="401",
     *     description="Unauthorized"
     *   )
     * )
     */
    public function __invoke()
    {
        return (new IndexResource((object) [
            'app_name' => config('app.name'),
            'database' => $this->checkDatabase(),
        ]))
        ->response()
        ->setStatusCode(200);
    }

    private function checkDatabase()
    {
        try {
            DB::connection()->getPdo();

            return true;
        } catch (\Exception $e) {
            $message = 'Could not connect to the database. Please check your configuration.';
            if (config('app.debug')) {
                $message .= ' Error: '.$e->getMessage();
            }

            return $message;
        }
    }
}
