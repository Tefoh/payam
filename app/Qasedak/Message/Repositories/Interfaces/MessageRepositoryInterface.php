<?php

namespace App\Qasedak\Message\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Qasedak\Message\Message;
use Illuminate\Database\Eloquent\Builder;
use Jsdecena\Baserepo\BaseRepositoryInterface;

Interface MessageRepositoryInterface extends BaseRepositoryInterface
{
    public function indexMessage() : Builder;

    public function indexMessageByAuthor() : Builder;

    public function indexDeletedMessage() : Builder;

    public function createMessage(array $params) : Message;

    public function createMessageByUsers(Request $request) : bool;

    public function updateMessage(array $params) : Message;

    public function findMessageById(int $id) : Message;

    public function findMessageWithTrashedById(int $id) : Message;

    public function showMessage(int $id, Message $message) : array;

    public function deleteMessage() : bool;

    public function getUsersByUrl(Request $request) : array;

    public function getAllUsers() : array;

    public function ajax($val, $isStar, $order = 'created_at DESC') : Builder;
}