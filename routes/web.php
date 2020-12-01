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


Route::get("/sendemail", "EmailController@index");
Route::get("/mails", "EmailController@list");
Route::get("/jsonemails", "EmailController@jsonEmails");
Route::get("/singlemail/{id}", "EmailController@getById");

Route::post("sendemail/send", "EmailController@send");