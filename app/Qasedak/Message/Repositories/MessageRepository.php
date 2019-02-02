<?php

namespace App\Qasedak\Message\Repositories;

use App\Qasedak\Message\Traits\CreateMessageTrait;
use App\Qasedak\Message\Traits\FindMessageTrait;
use App\User;
use App\Qasedak\Message\Message;
use Jsdecena\Baserepo\BaseRepository;
use App\Qasedak\Message\Traits\ShowMessageTrait;
use App\Qasedak\Message\Traits\IndexMessagesTrait;
use App\Qasedak\Message\Traits\AjaxMessageRepoTrait;
use App\Qasedak\Message\Traits\MessageUsersRepoTrait;
use App\Qasedak\Message\Repositories\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    use AjaxMessageRepoTrait;
    use MessageUsersRepoTrait;
    use IndexMessagesTrait;
    use ShowMessageTrait;
    use FindMessageTrait;
    use CreateMessageTrait;

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


}