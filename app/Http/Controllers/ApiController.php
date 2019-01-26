<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Qasedak\Message\Message;

class ApiController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['username', 'password']);


        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
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

    /**
     * Get the messeges.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages()
    {
        $messages = Message::whereUserId(auth()->guard('api')->user()->id)->whereIsRead(0)->get();
        foreach ($messages as $message) {
            $message->author = $message->sender->username;
            $message->time = $message->formatDifference();
        }

        $messages = json_decode($messages);
        return response()->json($messages);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        if (auth()->guard('api')->user()->profile_photo){
            $profile = route('home').'/images/'.auth()->guard('api')->user()->profile_photo;
        }else{
            $profile = null;
        }
        $message_unread = count(Message::whereUserId(auth()->guard('api')->user()->id)->whereIsRead(0)->get());
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'messages_unread' => $message_unread,
			'username' => auth()->guard('api')->user()->username,
            'profile' => $profile
        ]);
    }
}