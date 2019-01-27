<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Qasedak\File\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('profile',compact('user'));
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
