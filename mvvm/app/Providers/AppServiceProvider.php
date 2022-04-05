<?php

namespace App\Providers;

use App\ViewModels\UserViewModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $userViewModel = new UserViewModel();

        View::share('userViewModel', $userViewModel);
    }
}
