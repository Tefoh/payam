<?php

namespace App\Http\Controllers\Manage;

use App\Qasedak\Message\Repositories\Interfaces\ManageRepositoryInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class ManageController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/manage';

    /**
     * @var ManageRepositoryInterface
     */
    private $manageRepo;


    /**
     * ManageController constructor.
     * @param ManageRepositoryInterface $manageRepo
     */
    public function __construct(ManageRepositoryInterface $manageRepo)
    {
        $this->manageRepo = $manageRepo;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }


    /**
     * @return string
     */
    public function username()
    {
        return 'username';

    }


    /**
     * @return mixed
     */
    public function index()
    {
        return $this->manageRepo->index();
    }
}
