<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

//Routes to manage People
Route::resource('peoples', PeopleController::class);

//Route to welcome page
Route::get('/', function () {
    return view('welcome');
});
