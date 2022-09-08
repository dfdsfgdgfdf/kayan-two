<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            if(Auth::guard('doctor')->user()){
                $id = Auth::guard('doctor')->user()->id;
            }else{
                $id=0;
            }
            
            $public_data = [
                'admin_messages' => Message::where(['receiver_type' => Message::TYPE_ADMIN , 'read_status' => 0])->count(),
                'doctor_messages' => Message::where(['receiver_type' => Message::TYPE_DOCTOR ,'receiver_id' => $id, 'read_status' => 0])->count(),  
            ];
            $view->with('public_data', $public_data);
        });
    }
}
