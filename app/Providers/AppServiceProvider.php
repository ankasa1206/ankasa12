<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\User; 
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */ /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
     Paginator::useTailwind(); // Tambahkan ini

    View::composer(['admin.*', 'layouts.*'], function ($view) {
        $view->with('jumlahWali', User::where('role', 'wali')->count());
        $view->with('jumlahSantri', \App\Models\Santri::count());
    });
    }
    


}
