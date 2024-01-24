<?php

namespace App\Providers;

use App\Models\Link;
use App\Models\Settings;
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
        view()->composer('index.layouts.app', function ($view) {
            $name = Settings::where('key' , 'name')->pluck('value')->first();
            $title = Settings::where('key' , 'title')->pluck('value')->first();
            $logo = Settings::where('key' , 'logo')->pluck('value')->first();
            $etemad = Settings::where('key' , 'etemad')->pluck('value')->first();
            $fanavari = Settings::where('key' , 'fanavari')->pluck('value')->first();

            $links = Link::get();

            $view->with([
                'name' => $name,
                'title' => $title,
                'logo' => $logo,
                'etemad' => $etemad,
                'fanavari' => $fanavari,
                'links' => $links,
            ]);
        });

        view()->composer('manager.layouts.app', function ($view) {
            $logo = Settings::where('key' , 'logo')->pluck('value')->first();
            $view->with([
                'logo' => $logo,
            ]);
        });

        view()->composer('admin.layouts.app', function ($view) {
            $logo = Settings::where('key' , 'logo')->pluck('value')->first();

            $view->with([
                'logo' => $logo,
            ]);
        });
    }
}
