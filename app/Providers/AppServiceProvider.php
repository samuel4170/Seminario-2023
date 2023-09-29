<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('birthdate_not_future', function ($attribute, $value, $parameters, $validator) {
            $birthdate = \Carbon\Carbon::parse($value);
            $currentDate = \Carbon\Carbon::now()->subDay(); // Resta un día a la fecha actual

            return $birthdate <= $currentDate;
        });

        Validator::replacer('birthdate_not_future', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'La fecha de nacimiento no puede ser en el futuro.');
        });
    }
}
