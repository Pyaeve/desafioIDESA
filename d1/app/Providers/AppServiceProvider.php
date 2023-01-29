<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


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
        //traducimos los verbos de la API
        Route::resourceVerbs([
        'create' => 'crear',
        'edit' => 'editar',
        'store'=>'guardar'
        ]);
    }
}
