<?php

namespace App\Qasedak\User\Repositories;


use App\User;
use App\Qasedak\File\File;
use Illuminate\Support\Facades\Auth;
use Jsdecena\Baserepo\BaseRepository;
use App\Http\Requests\UserEditRequest;
use App\Qasedak\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Qasedak\User\Exceptions\UserNotFoundException;

class UserRepository extends BaseRepository implements UserRepositoryInterface {

    /**
     * @var User
     */
    private $user;


    /**
     * UserRepository constructor.
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }


    public function editUser(User $user)
    {
        return view('profile', compact('user'));
    }


    public function updateUser(UserEditRequest $request, User $user)
    {
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('profile_photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            File::create([
                'message_id' => Auth::id(),
                'path'       => $name
            ]);
            $input['profile_photo'] = $name;
        }
        $user->update($input);

        return $user;
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function destroyUser(User $user)
    {
        Auth::logout();
        return $user->delete();
    }
}