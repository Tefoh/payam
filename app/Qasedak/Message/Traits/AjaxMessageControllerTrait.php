<?php
namespace App\Qasedak\Message\Traits;


use Illuminate\Http\Request;

trait AjaxMessageControllerTrait
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stared ()
    {
        $messages = $this->messageRepo->ajax('is_stared', 1);
        $messages = $this->messageRepo->paginateBuilderResults($messages);

        return view('home', compact('messages'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function posted ()
    {
        $list = $this->messageRepo->indexMessageByAuthor();
        $messages = $this->messageRepo->paginateBuilderResults($list);

        return view('message.posted', compact('messages'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted ()
    {
        $list = $this->messageRepo->indexDeletedMessage();
        $messages = $this->messageRepo->paginateBuilderResults($list);

        return view('message.deleted', compact('messages'));
    }

    public function getUsers (Request $request)
    {
        $usersGetByUrl = $this->messageRepo->getUsersByUrl($request);
        $userList = $this->messageRepo->getAllUsers();
//        $messages = $this->messageRepo->indexMessage();

        return view('message.send', compact('usersGetByUrl', 'userList'));
    }

    /**
     * @param $label
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function label ($label)
    {
        switch ($label) {
            case 'important':
            case 'work':
            case 'document':
            case 'personal':
                $messages = $this->messageRepo->ajax('label', $label);
                $messages = $this->messageRepo->paginateBuilderResults($messages);
                return view('home', compact('messages'));
            default:
                return redirect()->back();
        }

    }
}