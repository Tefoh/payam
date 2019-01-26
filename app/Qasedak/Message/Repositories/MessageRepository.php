<?php

namespace App\Qasedak\Message\Repositories;

use App\User;
use Illuminate\Http\Request;
use App\Qasedak\Message\Message;
use Illuminate\Support\Facades\Auth;
use Jsdecena\Baserepo\BaseRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use App\Qasedak\Message\Exceptions\MessageNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Qasedak\Message\Exceptions\MessageInvalidArgumentException;
use App\Qasedak\Message\Repositories\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
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
     * @return Message
     */
    public function indexMessage () : Builder
    {
        try {
            return $this->indexAll();
        } catch (QueryException $e) {
            throw new MessageInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @return Message
     */
    public function indexMessageByAuthor () : Builder
    {
        try {
            return $this->indexAll('author');
        } catch (QueryException $e) {
            throw new MessageInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @return Message
     */
    public function indexDeletedMessage () : Builder
    {
        try {
            return $this->indexAllDeleted();
        } catch (QueryException $e) {
            throw new MessageInvalidArgumentException($e->getMessage());
        }
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

    public function updateMessage (array $params): Message
    {

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
     * @return array
     * @throws MessageNotFoundException
     */
    public function showMessage (int $id, Message $message): array
    {

        $message->is_read = 1;
        $message->save();

        $user = Auth::id();

        if ($message->user_id == $user) {
            $sender = $message->sender;
        } elseif ($message->author == $user) {
            $sender = $message->user;
        }

        return ['message' => $message, 'sender' => $sender];
    }
    public function deleteMessage (): bool
    {
        // TODO: Implement deleteMessage() method.
    }

    /**
     * @param string $user_id
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function indexAll(string $user_id = 'user_id', string $orderBy = 'created_at', string $sortBy = 'DESC')
    {
        $user = Auth::id();
        return $this->model->where($user_id, $user)->orderBy($orderBy, $sortBy)->with('user');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function splitUsers (Request $request): array
    {
        $users = explode(',', trim($request->username));

        foreach ($users as $id => $u) {
            $users[$id] = trim($u);
        }
        if (array_last($users)) {
            $users[$id] = rtrim(trim($u), ',');
        }
        return $users;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUsersByUrl(Request $request) : array
    {
        $usersGetByUrl = (array) $request->users;
        return $usersGetByUrl;
    }


    public function getAllUsers (): array
    {
        $users = $this->userModel->all()->pluck('username');
        return $users->toArray();
    }

    /**
     * @return mixed
     */
    public function indexAllDeleted ()
    {
        return $this->model->onlyTrashed()->where(function ($query) {
            $user =  Auth::id();
            $query->where('user_id', $user)
                ->orWhere('author', $user);
        })->with('user');
    }

    /**
     * @param $isStar
     * @return Builder
     */
    public function ajax ($val, $isStar, $order = 'created_at DESC'): Builder
    {
        return $this->model->where($val ,$isStar)
            ->where($this->ajaxCallback())
            ->orderByRaw($order);
    }
    /**
     * @return \Closure
     */
    protected function ajaxCallback (): \Closure
    {
        return function ($query) {
            $user = Auth::id();
            $query->where('user_id', $user)
                ->orWhere('author', $user);
        };
    }
}