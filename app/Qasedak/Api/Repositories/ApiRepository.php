<?php
namespace App\Qasedak\Api\Repositories;

use App\Qasedak\Message\Message;
use Illuminate\Http\JsonResponse;
use App\Qasedak\Api\Repositories\Traits\RespondWithToken;
use App\Qasedak\Api\Repositories\Interfaces\ApiRepositoryInterface;

class ApiRepository implements ApiRepositoryInterface
{
    use RespondWithToken;

    protected $model;

    public function __construct (Message $message)
    {
        $this->model = $message;
    }

    public function login (): JsonResponse
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }


    public function me (): JsonResponse
    {
        if (auth()->guard('api')->user()->profile_photo){
            $profile = route('home').'/images/'.auth()->guard('api')->user()->profile_photo;
        }else{
            $profile = null;
        }

        $user['name'] = auth()->guard('api')->user()->name;
        $user['username'] = auth()->guard('api')->user()->username;
        $user['profile_photo'] = auth()->guard('api')->user()->profile_photo;
        $user['created_at'] = auth()->guard('api')->user()->created_at;
        $user['updated_at'] = auth()->guard('api')->user()->updated_at;
        $user['profile'] = $profile;

        return response()->json($user);
    }

    public function message (): JsonResponse
    {
        $messages = $this->model->whereUserId(auth()->guard('api')->user()->id)->whereIsRead(0)->get();
        foreach ($messages as $message) {
            $message->author = $message->sender->username;
            $message->time = $message->formatDifference();
        }

        $messages = json_decode($messages);
        return response()->json($messages);
    }

    public function logout (): JsonResponse
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh (): JsonResponse
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }
}