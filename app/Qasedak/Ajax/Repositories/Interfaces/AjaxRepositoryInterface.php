<?php

namespace App\Qasedak\Ajax\Repositories\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface AjaxRepositoryInterface
{
    public function index (): Collection;

    public function fetch (string $query): JsonResponse;

    public function starMessage (int $id, int $isStar);

    public function label (Request $request, string $label);

    public function readMessage (array $data);

    public function unreadMessage (array $data);

    public function softDeleteMessage (array $data);

    public function deleteMessage (array $data);

    public function undoMessage (array $data);
}