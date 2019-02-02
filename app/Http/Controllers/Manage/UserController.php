<?php

namespace App\Http\Controllers\Manage;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function ban(Request $request)
    {
        $users = $request->get('ban');
        foreach ($users as $id) {
            $user = User::find($id);
            $user->is_baned = 1;
            $user->save();
        }
    }
    
    public function destroy(Request $request)
    {
        $users = $request->get('deleted');
        foreach ($users as $id) {
	        $user = User::find($id);
            if ($user->delete()) {
            	$deletedUsers[] = $user;
            }
        }
        return $deletedUsers;
    }
}
