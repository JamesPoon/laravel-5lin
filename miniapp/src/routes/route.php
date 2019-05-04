<?php
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix"    =>  "auth/mapp",
    "namespace" =>  "Weixin\App\Controllers",
], function (){
    Route::get("login", "AuthController@login");
    Route::get("register", "AuthController@register");
    Route::post("login", "AuthController@login");
    Route::post("register", "AuthController@register");
});