<?php

namespace App\Http\Controllers;

use App\User;
use App\Qasedak\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageStoreRequest;
use App\Qasedak\Repositories\Interfaces\MessageRepositoryInterface;

class MessageHomeController extends Controller
{
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
    public function index()
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
    public function create()
    {
        $senduser = $this->messageRepo->getUsersByUrl();
//        $messages = $this->messageRepo->indexMessage();

        return view('send', compact('senduser'));

    }

    /**
     * create a new message
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(MessageStoreRequest $request)
    {
        if (! $this->messageRepo->createMessageByUsers($request)) {
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
    public function show($id)
    {
        $message = $this->messageRepo->findMessageWithTrashedById($id);

        $this->authorize('view', $message);
        $params = $this->messageRepo->showMessage($id, $message);
        extract($params);

        return view('show', compact('message','sender'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stared()
    {
        $messages = Message::where('is_stared',1)->where(function ($query) {
            $query->where('user_id',Auth::id())
                ->orWhere('author', Auth::id());
        })->orderByRaw('created_at DESC')->paginate(50);

        return view('home', compact('messages'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function posted()
    {
        $list = $this->messageRepo->indexMessageByAuthor();
        $messages = $this->messageRepo->paginateBuilderResults($list);

        return view('posted', compact('messages'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted()
    {
        $list = $this->messageRepo->indexDeletedMessage();
        $messages = $this->messageRepo->paginateBuilderResults($list);

        return view('deleted', compact('messages'));
    }

    public function label($label)
    {
        switch ($label){
            case 'important':
            case 'work':
            case 'document':
            case 'personal':
                $messages = Message::where(function ($query) {
                    $query->where('user_id',Auth::id())
                        ->orWhere('author', Auth::id());
                })->where('label',$label)->orderByRaw('created_at DESC')->paginate(50);
                return view('home', compact('messages'));
            default: return redirect()->back();
        }

    }

}
