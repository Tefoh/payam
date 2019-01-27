<?php
namespace App\Qasedak\Message\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait AjaxMessageRepoTrait
{

    /**
     * @param $isStar
     * @return Builder
     */
    public function ajax ($val, $isStar, $order = 'created_at DESC'): Builder
    {
        return $this->model->where($val, $isStar)
            ->where($this->ajaxCallback())
            ->orderByRaw($order);
    }

    /**
     * @return \Closure
     */
    protected function ajaxCallback (): \Closure
    {
        return function ($query) {
            $user = Auth::id();
            $query->where('user_id', $user)
                ->orWhere('author', $user);
        };
    }
}