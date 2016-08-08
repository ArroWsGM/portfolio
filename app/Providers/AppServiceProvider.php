<?php

namespace App\Providers;
use DB;
use App\Admin\Setting;
use App\Admin\Message;
use Illuminate\Support\ServiceProvider;

use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            view()->share([
                            'cms_about' => DB::table('about')->first(),
                            'messages_new' => Message::whereHas('status', function($q){
                                                                                $q->where('status_name', 'new');
                                                                            })->count(),
                            'view_name' => $view->getName(),
                            'all_settings' => Setting::getAllSettings(),
                         ]);
        });

        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('uk_UA');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
