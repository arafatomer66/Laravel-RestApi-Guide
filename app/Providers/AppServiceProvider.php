<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Product ;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
class AppServiceProvider extends ServiceProvider

{
    public function boot()
            {
                Schema::defaultStringLength(191);
                //event
                User::created(function($user){
                        Mail::to($user)->send(new UserCreated($user));
                });
                User::updated(function($user){
                    if($user->isDirty('email')){
                        Mail::to($user)->send(new UserCreated($user));
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
