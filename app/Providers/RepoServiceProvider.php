<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $path = 'App\Http\Repository\Admin\\';
        //$this->app->bind('App\Http\Repository\CategoryRepositoryInterface','App\Http\Repository\CategoryRepository');
        $this->app->bind($path.'CategoryRepositoryInterface',$path.'CategoryRepository');
        $this->app->bind($path.'SubCategoryRepositoryInterface',$path.'SubCategoryRepository');
        $this->app->bind($path.'ProductRepositoryInterface',$path.'ProductRepository');
        $this->app->bind($path.'FilterRepositoryInterface',$path.'FilterRepository');
        $this->app->bind($path.'SubFilterRepositoryInterface',$path.'SubFilterRepository');

        /*********************************************************************************************************/

        $pathCustomer = 'App\Http\Repository\Customer\\';

        $this->app->bind($pathCustomer.'HomePageRepositoryInterface',$pathCustomer.'HomePageRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
