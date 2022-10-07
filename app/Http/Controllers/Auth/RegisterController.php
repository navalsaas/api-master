<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Users\User;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Providers\RouteServiceProvider;
use App\Support\Http\Controllers\BaseController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use  Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * @OA\Post(
     *   tags={"auth"},
     *   path="/auth/register",
     *    @OA\RequestBody(
     *       required=true,
     *       description="Register User",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(ref="#/components/schemas/UserRegisterRequest")
     *       )
     *   ),
     *   summary="Register User",
     *    @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/UserResource")),
     *     ),
     *   @OA\Response(
     *     response="422",
     *     description="Informa os campos inválidos ou faltando"
     *   )
     * )
     */

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();

        event(new Registered($user = $this->create($data)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return new UserResource($user);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, []);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Domains\Users\User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->name = data_get($data, 'name');
        $user->email = data_get($data, 'email');
        $user->password = data_get($data, 'password');
        $user->save();

        return $user;
    }
}
