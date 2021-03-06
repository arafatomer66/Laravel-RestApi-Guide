<?php
namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Product ;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
class AppServiceProvider extends ServiceProvider
{
    public function boot()
            {
                Schema::defaultStringLength(191);
                //event
                User::created(function($user){
                    retry(5 , function() use ($user){
                        Mail::to($user)->send(new UserCreated($user));
                    },100);

                });
                User::updated(function($user){
                    if($user->isDirty('email')){
                        retry(5 , function() use ($user){
                            Mail::to($user)->send(new UserCreated($user));
                        },100);
                    }
                });
                Product::updated(function($product){
                    if($product->quantity == 0 && $product->isAvailable() ){
                         $product->status = Product::AVAILABLE_PRODUCT ;
                    }
               });
            }
    public function register()
    {

    }
}
