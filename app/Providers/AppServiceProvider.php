<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View()->composer('dashboard.layouts.sidebar', function ($view) {
            $users = User::where('id','!=',auth()->id())->with(['lastMessage'])->get();
            $view->with([
                'users' => $users
            ]);

        });
    }
}
