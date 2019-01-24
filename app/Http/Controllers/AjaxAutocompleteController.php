<?php

namespace App\Http\Controllers;

use App\Qasedak\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxAutocompleteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {
        $users = DB::table('users')->get(array('username'));
        return view('send', compact('users'));
    }

    /**
     * @param Request $request
     */
    public function fetch (Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = User::where('username', 'LIKE', '%' . $query . '%')->take(5)->get();
//            $output = '<ul class="list-group" style="display: block;position:relative;">';
            foreach ($data as $key => $row) {
                $output[] = $row->username;
            }
            /*            $output .= '<br>';*/
            echo json_encode($output);
        }
    }

    /**
     * @param Request $request
     */
    public function stared (Request $request)
    {
        $message = Message::find($request->get('data'));
        $message->is_stared = 1;
        $message->save();
    }

    /**
     * @param Request $request
     */
    public function star (Request $request)
    {
        $message = Message::find($request->get('data'));
        $message->is_stared = 0;
        $message->save();
    }

    /**
     * @param Request $request
     */
    public function ajax (Request $request)
    {
        if ($label = $request->get('label')) {
            $this->getLabel($request, $label);
        } elseif ($request->get('read')) {
            $reads = $request->get('read');
            foreach ($reads as $read) {
                $this->updateMessageByAjax($read, 'is_read', 1);
            }
        } elseif ($request->get('unread')) {
            $unreads = $request->get('unread');
            foreach ($unreads as $unread) {
                $this->updateMessageByAjax($unread, 'is_read', 0);
            }
        } elseif ($request->get('deleting')) {
            $deletingMessages = $request->get('deleting');
            foreach ($deletingMessages as $label) {
                Message::find($label)->delete();
            }
        } elseif ($request->get('undo')) {
            $undos = $request->get('undo');
            foreach ($undos as $undo) {
                Message::withTrashed()->find($undo)->restore();
            }
        } elseif ($request->get('drop')) {
            $drops = $request->get('drop');
            foreach ($drops as $drop) {
                Message::withTrashed()->find($drop)->forceDelete();
            }
        }

    }

    /**
     * @param Request $request
     */
    public function getLabel (Request $request, $requestLabel)
    {
        $labels = $request->get('data');
        foreach ($labels as $label) {
            $message = Message::find($label);
            $message->label = $requestLabel;
            $message->save();
            $messages[] = $message->id;
        }
        return [$messages, $requestLabel];
    }

    /**
     * @param $unread
     */
    protected function updateMessageByAjax ($value, $prop, $key): void
    {
        $message = Message::find($value);
        $message->$prop = $key;
        $message->save();
    }

}