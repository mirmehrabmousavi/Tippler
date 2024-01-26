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
            $name = Settings::where('key', 'name')->pluck('value')->first();
            $title = Settings::where('key', 'title')->pluck('value')->first();
            $logo = Settings::where('key', 'logo')->pluck('value')->first();
            $etemad = Settings::where('key', 'etemad')->pluck('value')->first();
            $fanavari = Settings::where('key', 'fanavari')->pluck('value')->first();

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
            $logo = Settings::where('key', 'logo')->pluck('value')->first();
            $view->with([
                'logo' => $logo,
            ]);
        });

        view()->composer('admin.layouts.app', function ($view) {
            $requestUrl = request()->path(); // Get the path of the current URL
            $segments = explode('/', $requestUrl); // Split the URL into segments
            $index = array_search('admin', $segments); // Find the index of 'admin'
            $url1 = ucwords($segments[$index + 1]); // Get the segment after 'admin'
            if (!empty($segments[$index + 2])) {
                $url2 = ucwords($segments[$index + 2]); // Get the segment after 'admin'
            }else{
                $url2 = '';
            }

            $name = Settings::where('key', 'name')->pluck('value')->first();
            $title = Settings::where('key', 'title')->pluck('value')->first();
            $ico = Settings::where('key', 'ico')->pluck('value')->first();
            $logo = Settings::where('key', 'logo')->pluck('value')->first();

            $view->with([
                'url1' => $url1,
                'url2' => $url2,
                'name' => $name,
                'title' => $title,
                'ico' => $ico,
                'logo' => $logo,
            ]);
        });
    }
}
