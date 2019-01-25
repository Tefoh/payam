<?php
namespace App\Qasedak\Ajax\Repositories;

use App\User;
use App\Qasedak\Message;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepository;
use App\Qasedak\Ajax\Repositories\Interfaces\AjaxRepositoryInterface;

class AjaxRepository extends BaseRepository implements AjaxRepositoryInterface
{
    /**
     * AjaxRepository constructor.
     * @param Message $message
     */
    public function __construct (Message $message)
    {
        parent::__construct($message);
        $this->model = $message;
    }

    public function index (): Collection
    {
        return DB::table('users')->get(array('username'));
    }

    public function fetch (string $query): JsonResponse
    {
        $data = User::where('username', 'LIKE', '%' . $query . '%')->take(5)->get();
//            $output = '<ul class="list-group" style="display: block;position:relative;">';
        foreach ($data as $key => $row) {
            $output[] = $row->username;
        }
        /*            $output .= '<br>';*/
        echo json_encode($output);
        return response()->json($output);
    }

    public function starMessage (int $id, int $isStar)
    {

        $message = $this->model->find($id);
        $message->is_stared = $isStar;
        $message->save();
    }

    public function label (Request $request, string $label)
    {
        $this->getLabel($request, $label);
    }

    public function readMessage (array $data)
    {
        $this->updateMessageByAjax($data, 'is_read',1);
    }

    public function unreadMessage (array $data)
    {
        $this->updateMessageByAjax($data, 'is_read',0);
    }

    public function softDeleteMessage (array $data)
    {
        foreach ($data as $label) {
            $this->model->find($label)->delete();
        }
    }

    public function deleteMessage (array $data)
    {
        foreach ($data as $drop) {
            $this->model->withTrashed()->find($drop)->forceDelete();
        }
    }

    public function undoMessage (array $data)
    {
        foreach ($data as $undo) {
            $this->model->withTrashed()->find($undo)->restore();
        }
    }

    /**
     * @param Request $request
     */
    protected function getLabel (Request $request, $requestLabel)
    {
        $labels = $request->get('data');
        foreach ($labels as $label) {
            $message = $this->model->find($label);
            $message->label = $requestLabel;
            $message->save();
            $messages[] = $message->id;
        }
        return [$messages, $requestLabel];
    }

    /**
     * @param $unread
     */
    protected function updateMessageByAjax ($data, $prop, $key): void
    {
        foreach ($data as $datum) {
            $message = $this->model->find($datum);
            $message->$prop = $key;
            $message->save();
        }
    }
}