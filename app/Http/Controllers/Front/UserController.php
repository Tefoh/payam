<?php

namespace App\Http\Controllers\Front;

use App\File;
use App\Http\Controllers\Controller;
use App\User;
use App\Qasedak\Message\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $userid = Auth::id();
        $user = Auth::user();
        $users = User::where('id', '!=', $user)->get();
        $threemessages = Message::where('user_id',$userid)->where('is_read',0)->take(3)->get();

        $count_messages = count(Message::where('user_id',$userid)->get());
        $send = count(Message::where('author',$userid)->get());
        $not_read = count(Message::where('user_id',$userid)->where('is_read',0)->get());
        $deleted = count(Message::where('user_id',$userid)->onlyTrashed()->get());


        return view('profile',compact('user','users','threemessages', 'send', 'deleted', 'not_read', 'count_messages'));
    }

    /**
     * @param UserEditRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserEditRequest $request, User $user)
    {
        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('profile_photo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            File::create([
                'message_id'=>Auth::id(),
                'path'=>$name
            ]);
            $input['profile_photo'] = $name;
        }
        $user->update($input);

        return redirect('/home');

    }


    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('login');
    }
}
