<?php
namespace App\Qasedak\Api\Repositories\Traits;

use App\Qasedak\Message\Message;

trait RespondWithToken
{

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken ($token)
    {
        if (auth()->guard('api')->user()->profile_photo) {
            $profile = route('home') . '/images/' . auth()->guard('api')->user()->profile_photo;
        } else {
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