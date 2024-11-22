<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DanhMuc;
use App\Http\Controllers\CategoriesController;
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
            $danhmucs = app(CategoriesController::class)->getAllDanhMuc();
            $view->with('Alldanhmucs', $danhmucs);
        });

        Paginator::useBootstrapFour();
    }
}




