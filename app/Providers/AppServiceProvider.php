<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Components\Form\{
    appendIcon,
    button,
    inputError,
    inputText,
    label
};

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
        Blade::component('input-text', inputText::class);
        Blade::component('button', button::class);
        Blade::component('append-icon', appendIcon::class);
        Blade::component('input-error', inputError::class);
        Blade::component('label', label::class);

        $setting = Setting::first();
        View::share('setting', $setting);
    }
}
