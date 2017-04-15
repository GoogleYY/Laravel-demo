<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\CommentForward;

use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');

        $categorys = \DB::table('categorys')->get();

        view()->share('categorys', $categorys);
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
