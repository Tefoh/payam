<?php

namespace App\Qasedak\Ajax\Repositories\Interfaces;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface AjaxRepositoryInterface
{
    public function index (): Collection;

    public function fetch (string $query): JsonResponse;

    public function starMessage ($id, $isStar);

    public function label (Request $request, $data);

    public function readMessage ($data);

    public function unreadMessage ($data);

    public function softDeleteMessage ($data);

    public function deleteMessage ($data);

    public function undoMessage ($data);
}