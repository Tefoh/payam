<?php
namespace App\Qasedak\Message\Traits;


use App\Qasedak\Message\Exceptions\MessageNotFoundException;
use App\Qasedak\Message\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

trait ShowMessageTrait
{

    /**
     * @param int $id
     * @param Message $message
     * @return array
     * @throws MessageNotFoundException
     */
    public function showMessage (int $id, Message $message): array
    {
        try {
            $message->is_read = 1;
            $message->save();

            $user = Auth::id();
            $sender = '';
            if ($message->user_id == $user) {
                $sender = $message->sender;
            } elseif ($message->author == $user) {
                $sender = $message->user;
            }

            return ['message' => $message, 'sender' => $sender];
        } catch (ModelNotFoundException $e) {
            throw new MessageNotFoundException;
        }
    }
}