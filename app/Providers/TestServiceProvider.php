<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 13:34
 */

namespace App\Providers;


use App\Service\Test;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Test::class, function ($app) {
            return new Test();
        });
    }
}