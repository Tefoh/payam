<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qasedak\Ajax\Repositories\Interfaces\AjaxRepositoryInterface;

class AjaxAutocompleteController extends Controller
{

    /**
     * @var AjaxRepositoryInterface
     */
    private $ajaxRepo;

    /**
     * AjaxAutocompleteController constructor.
     * @param AjaxRepositoryInterface $ajaxRepo
     */
    public function __construct (AjaxRepositoryInterface $ajaxRepo)
    {
        $this->ajaxRepo = $ajaxRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {
        $users = $this->ajaxRepo->index();
        return view('send', compact('users'));
    }

    /**
     * @param Request $request
     */
    public function fetch (Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $this->ajaxRepo->fetch($query);
        }
    }

    /**
     * @param Request $request
     */
    public function stared (Request $request)
    {
        $message = $request->get('data');
        $this->ajaxRepo->starMessage($message, 1);
    }

    /**
     * @param Request $request
     */
    public function star (Request $request)
    {
        $message = $request->get('data');
        $this->ajaxRepo->starMessage($message, 0);
    }

    /**
     * @param Request $request
     */
    public function ajax (Request $request)
    {
        $mappers = [
            'label'     => 'label',
            'read'      => 'readMessage',
            'unread'    => 'unreadMessage',
            'deleting'  => 'softDeleteMessage',
            'drop'      => 'deleteMessage',
            'undo'      => 'undoMessage'
        ];

        foreach ($mappers as $key => $mapper){
            if ($label = $request->get('label')) {
                $this->ajaxRepo->label($request, $label);
                continue;
            }
            if ($data = $request->get($key)) {
                $this->ajaxRepo->$mapper($data);
            }
        }
    }


}