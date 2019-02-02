<?php
namespace App\Qasedak\Message\Traits;


use App\Qasedak\Message\Exceptions\MessageNotFoundException;
use App\Qasedak\Message\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait FindMessageTrait
{

    /**
     * @param int $id
     * @return Message
     * @throws MessageNotFoundException
     */
    public function findMessageById (int $id): Message
    {
        try {
            return $this->model->findOrFail($id);
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
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new MessageNotFoundException;
        }
    }
}