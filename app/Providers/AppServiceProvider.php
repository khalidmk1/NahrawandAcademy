<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

   

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        Paginator::useBootstrap();

        Validator::extend('filled_if_empty', function ($attribute, $value, $parameters, $validator) {
            $field = $parameters[0];
            $data = $validator->getData();
        
            if (empty($data[$attribute]) && !empty($data[$field])) {
                return true;
            }
        
            return !empty($data[$attribute]);
        });
    }
}
