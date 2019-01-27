<?php
namespace App\Qasedak\Message\Traits;


use App\Qasedak\Message\Exceptions\MessageInvalidArgumentException;
use App\Qasedak\Message\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

trait IndexMessagesTrait
{

    /**
     * @return Message
     */
    public function indexMessage (): Builder
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
    public function indexMessageByAuthor (): Builder
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
    public function indexDeletedMessage (): Builder
    {
        try {
            return $this->indexAllDeleted();
        } catch (QueryException $e) {
            throw new MessageInvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param string $user_id
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function indexAll (string $user_id = 'user_id', string $orderBy = 'created_at', string $sortBy = 'DESC')
    {
        $user = Auth::id();
        return $this->model->where($user_id, $user)->orderBy($orderBy, $sortBy)->with('user');
    }

    /**
     * @return mixed
     */
    public function indexAllDeleted ()
    {
        return $this->model->onlyTrashed()->where(function ($query) {
            $user = Auth::id();
            $query->where('user_id', $user)
                ->orWhere('author', $user);
        })->with('user');
    }
}