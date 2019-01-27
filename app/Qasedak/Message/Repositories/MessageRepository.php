<?php

namespace App\Qasedak\Message\Repositories;

use App\User;
use Illuminate\Http\Request;
use App\Qasedak\Message\Message;
use Illuminate\Support\Facades\Auth;
use Jsdecena\Baserepo\BaseRepository;
use Illuminate\Support\Facades\Session;
use App\Qasedak\Message\Traits\IndexMessagesTrait;
use App\Qasedak\Message\Traits\AjaxMessageRepoTrait;
use App\Qasedak\Message\Traits\MessageUsersRepoTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Qasedak\Message\Exceptions\MessageNotFoundException;
use App\Qasedak\Message\Repositories\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    use AjaxMessageRepoTrait, MessageUsersRepoTrait, IndexMessagesTrait;

    protected $userModel;
    /**
     * MessageRepository constructor.
     *
     * @param Message $message
     */
    public function __construct (Message $message, User $user)
    {
        parent::__construct($message);
        $this->model = $message;
        $this->userModel = $user;
    }


    /**
     * @param array $params
     * @return Message
     */
    public function createMessage (array $params): Message
    {
        return $this->create($params);
    }


    /**
     * @param Request $request
     * @return bool
     */
    public function createMessageByUsers (Request $request): bool
    {
        $users = $this->splitUsers($request);

        foreach ($users as $user)
        {
            if (is_object($this->userModel->where('username',$user)->first())){
                $this->createMessage([
                    'title'     => $request->title,
                    'body'      => $request->body,
                    'user_id'   => $this->userModel->where('username',$user)-> first()->id,
                    'author'    => Auth::id(),
                ]);
            } else {
                Session::flash('user_not_found', 'متاسفانه این نام در پایگاه داده وجود ندارد.');
                return false;
            }
        }
        return true;
    }

    /**
     * @param int $id
     * @return Message
     * @throws MessageNotFoundException
     */
    public function findMessageById (int $id): Message
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new MessageNotFoundException;
        }
    }

    /**
     * @param int $id
     * @return Message
     * @throws MessageNotFoundException
     */
    public function findMessageWithTrashedById (int $id): Message
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new MessageNotFoundException;
        }
    }


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
        }catch (ModelNotFoundException $e ){
            throw new MessageNotFoundException;
        }
    }


}