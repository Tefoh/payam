<?php
namespace App\Qasedak\User\Repositories\Interfaces;


use App\User;
use App\Http\Requests\UserEditRequest;

interface UserRepositoryInterface {

    public function editUser(User $user);

    public function updateUser(UserEditRequest $request, User $user);

    public function destroyUser(User $user);

}