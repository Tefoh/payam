<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Qasedak\File\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Qasedak\User\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;


    /**
     * UserController constructor.
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return $this->userRepo->editUser($user);
    }

    /**
     * @param UserEditRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserEditRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $this->userRepo->updateUser($request, $user);
        return redirect('/home');
    }


    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('forceDelete', $user);
        $this->userRepo->destroyUser($user);
        if (Auth::user()->hasRole('superAdmin')) {
            redirect('manage');
        }
        return redirect('login');
    }
}
