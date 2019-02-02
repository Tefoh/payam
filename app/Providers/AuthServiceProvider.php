<?php

namespace App\Providers;

use App\Qasedak\File\File;
use App\User;
use App\Qasedak\Message\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        Message::class => 'App\Policies\MessagePolicy',
        User::class => 'App\Policies\UserPolicy',
        File::class => 'App\Policies\FileAccessPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        view()->composer('layouts.mail', function ($view){
            $user = Auth::id();

            $view->with([
                'threemessages'=>Message::where('user_id',$user)->where('is_read',0)->take(3)->latest('created_at')->get(),

                'not_read'=>count(Message::where('user_id',$user)->where('is_read',0)->get()),

                'count_messages'=>count(Message::where('user_id',$user)->get()),

                'send'=>count(Message::where('author',$user)->get()),

                'deleted'=>count(Message::where(function ($query) {
                    $query->where('user_id',Auth::id())
                        ->orWhere('author', Auth::id());
                })->onlyTrashed()->get()),
                'users' => User::where('id', '!=', $user)->get(),
            ]);
        });
    }
}
