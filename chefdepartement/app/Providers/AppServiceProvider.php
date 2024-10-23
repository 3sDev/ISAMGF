<?php

namespace App\Providers;
use App\Models\Variable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    

    // If you also want to fetch data from the database using Eloquent, you can do so here


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
             URL::forceScheme('https'); 
      //
   

}
}



