<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DanhMuc;
use App\Http\Controllers\DanhmucController;

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
        view()->composer('users/*', function ($view): void {
            $danhmucs = app(DanhmucController::class)->getAllDanhMuc();
            $view->with('danhmucs', $danhmucs);
        });
    }
}




