<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DanhMuc;
use App\Http\Controllers\DanhmucController;
use Illuminate\Pagination\Paginator;

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
        view()->composer('*', function ($view): void {
            $danhmucs = app(DanhmucController::class)->getAllDanhMuc();
            $view->with('Alldanhmucs', $danhmucs);
        });

        Paginator::useBootstrapFour();
    }
}




