<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\MessageResource;
use App\Providers\RouteServiceProvider;
use App\Support\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')
            ->except('logout');
    }

    /**
     * @OA\Post(
     *   tags={"auth"},
     *   path="/auth/login",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Login user with email and password",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/AuthLoginRequest")
     *       )
     *   ),
     *   summary="Auth/login",
     *   @OA\Response(
     *     response="401",
     *     description="Unauthorized"
     *   )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized', 'code' => 401], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *   tags={"auth"},
     *   path="/auth/logout",
     *   summary="Auth/Logout",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/MessageResource")),
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
    public function logout()
    {
        auth()->logout();

        return (new MessageResource((object) ['message' => 'Deslogado com sucesso!']))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
