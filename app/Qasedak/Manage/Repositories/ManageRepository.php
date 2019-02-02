<?php

namespace App\Qasedak\Message\Repositories;

use App\User;
use Jsdecena\Baserepo\BaseRepository;
use App\Qasedak\Message\Repositories\Interfaces\ManageRepositoryInterface;

class ManageRepository extends BaseRepository implements ManageRepositoryInterface {

    /**
     * ManageRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->indexAll();
        $users = $this->paginateBuilderResults($users);
        return view('manage.index', compact('users'));
    }


    /**
     * @return mixed
     */
    public function indexAll()
    {
        return $this->model->select('*')->with('messages');
    }
}