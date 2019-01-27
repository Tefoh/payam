<?php
namespace App\Qasedak\Api\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;

interface ApiRepositoryInterface
{
    public function login() : JsonResponse;

    public function logout() : JsonResponse;

    public function me() : JsonResponse;

    public function message() : JsonResponse;

    public function refresh() : JsonResponse;
}