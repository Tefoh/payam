<?php

namespace App\Http\Controllers;

use App\Qasedak\Api\Repositories\Interfaces\ApiRepositoryInterface;

class ApiController extends Controller
{
    /**
     * @var ApiRepositoryInterface
     */
    private $apiRepo;

    /**
     * Create a new AuthController instance.
     *
     * @param ApiRepositoryInterface $apiRepo
     */
    public function __construct(ApiRepositoryInterface $apiRepo)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->apiRepo = $apiRepo;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        return $this->apiRepo->login();
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->apiRepo->me();
    }

    /**
     * Get the messeges.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages()
    {
        return $this->apiRepo->message();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->apiRepo->logout();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->apiRepo->refresh();
    }

}