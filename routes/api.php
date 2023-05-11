<?php

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("v1")->namespace("App\\Http\\Controllers\\Api\\V1")->group(function(){

    Route::prefix("auth")->group(function(){
        Route::post("login", "AuthController@login");
        Route::post("refresh", "AuthController@refresh");
        Route::post("logout", "AuthController@logout");
        Route::get("me", "AuthController@me");
        Route::put("me", "AuthController@update");
    });

    Route::middleware("auth:api")->group(function(){
        
        Route::prefix("client")->group(function(){
            Route::post("/", "ClientsController@create");
            Route::get("/", "ClientsController@all");
            Route::get("/{id}", "ClientsController@get");
            Route::put("/{id}", "ClientsController@update");
            Route::delete("/{id}", "ClientsController@delete");
        });
        
        Route::prefix("credential")->group(function(){
            Route::get("/types", "ParamsController@credentialTypes");

            Route::post("/", "CredentialsController@create");
            Route::get("/", "CredentialsController@all");
            Route::get("/{id}", "CredentialsController@get");
            Route::put("/{id}", "CredentialsController@update");
            Route::delete("/{id}", "CredentialsController@delete");
        });
        
        Route::prefix("file")->group(function(){
            Route::post("/", "FilesController@create");
            Route::get("/{id}", "FilesController@get");
            Route::delete("/{id}", "FilesController@delete");
        });
        
        Route::prefix("project")->group(function(){
            Route::post("/", "ProjectsController@create");
            Route::get("/", "ProjectsController@all");
            Route::get("/{id}", "ProjectsController@get");
            Route::put("/{id}", "ProjectsController@update");
            Route::delete("/{id}", "ProjectsController@delete");
        });
        
        Route::prefix("user")->group(function(){
            Route::get("/roles", "ParamsController@userRoles");
            
            Route::post("/", "UsersController@create");
            Route::get("/", "UsersController@all");
            Route::get("/{id}", "UsersController@get");
            Route::put("/{id}", "UsersController@update");
            Route::delete("/{id}", "UsersController@delete");
        });
    });
});
