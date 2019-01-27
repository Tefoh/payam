<?php

namespace App\Http\Controllers\Front;

use App\Qasedak\Message\Traits\AjaxMessageControllerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Qasedak\Message\Repositories\Interfaces\MessageRepositoryInterface;

class MessageHomeController extends Controller
{
    use AjaxMessageControllerTrait;

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepo;

    /**
     * MessageHomeController constructor.
     * @param MessageRepositoryInterface $messageRepo
     */
    public function __construct (MessageRepositoryInterface $messageRepo)
    {
        $this->messageRepo = $messageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $list = $this->messageRepo->indexMessage();
        $messages = $this->messageRepo->paginateBuilderResults($list);

        return view('home', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        $userList = $this->messageRepo->getAllUsers();

        return view('message.send', compact( 'userList'));
    }

    /**
     * create a new message
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store (MessageStoreRequest $request)
    {
        if (!$this->messageRepo->createMessageByUsers($request)) {
            return redirect()->back();
        }
        return redirect('home');
    }

    /**
     * show the message
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show ($id)
    {
        $message = $this->messageRepo->findMessageWithTrashedById($id);

        $this->authorize('view', $message);
        $params = $this->messageRepo->showMessage($id, $message);
        extract($params);

        return view('message.show', compact('message', 'sender'));
    }
}
