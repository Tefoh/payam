<?php
namespace App\Qasedak\Message\Traits;


use Illuminate\Http\Request;

trait MessageUsersRepoTrait
{

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
    public function getUsersByUrl (Request $request): array
    {
        $usersGetByUrl = (array)$request->users;
        return $usersGetByUrl;
    }

    public function getAllUsers (): array
    {
        $users = $this->userModel->all()->pluck('username');
        return $users->toArray();
    }
}