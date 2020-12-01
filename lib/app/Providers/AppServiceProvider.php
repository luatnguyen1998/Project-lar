<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Category;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $data ['cate_all'] = Category::all();
        view()->share($data);

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
