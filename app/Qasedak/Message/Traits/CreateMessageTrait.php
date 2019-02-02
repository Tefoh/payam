<?php
namespace App\Qasedak\Message\Traits;

use App\Qasedak\Message\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait CreateMessageTrait
{

    /**
     * @param array $params
     * @return Message
     */
    public function createMessage (array $params): Message
    {
        return $this->model->create($params);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function createMessageByUsers (Request $request): bool
    {
        $users = $this->splitUsers($request);

        foreach ($users as $user) {
            if (is_object($this->userModel->where('username', $user)->first())) {
                $this->createMessage([
                    'title' => $request->title,
                    'body' => $request->body,
                    'user_id' => $this->userModel->where('username', $user)->first()->id,
                    'author' => Auth::id(),
                ]);
            } else {
                Session::flash('user_not_found', 'متاسفانه این نام در پایگاه داده وجود ندارد.');
                return false;
            }
        }
        return true;
    }

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
}