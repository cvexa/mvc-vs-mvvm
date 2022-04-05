<?php

use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group( function (){
    //index
    Route::get('users', function (){
        return view('users.index');
    })->name('users.index');

    //create
    Route::get('users/create', function (){
        return view('users.create');
    })->name('users.create');

    //store
    Route::post('users', '\App\ViewModels\UserViewModel@store');

    //edit
    Route::get('users/{user}/edit ', function (){
        return view('users.edit');
    })->name('users.edit');

    //update
    Route::put('users/{user}', '\App\ViewModels\UserViewModel@update');

    //delete
    Route::delete('users/{user}', '\App\ViewModels\UserViewModel@delete');
});


require __DIR__.'/auth.php';
