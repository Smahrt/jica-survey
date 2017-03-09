<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {
        view()->composer('*', function($view)
            {
                $res_contact = DB::select('SELECT * FROM contacts JOIN contact_type ON contacts.contact_type_id = contact_type.id');
                $res_con_type = DB::select('SELECT * FROM contact_type');
                $res_survey = DB::select('SELECT * FROM surveys');
        
                $view->with('res_contact',$res_contact)->with('res_con_type',$res_con_type)->with('res_survey',$res_survey);
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
