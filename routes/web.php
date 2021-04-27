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
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',"\App\Http\Controllers\TicketController@dashboard")->name('dashboard');

Route::get('/acessar', "\App\Http\Controllers\TicketController@form_login")->name('acessar');

Route::get('/logout', "\App\Http\Controllers\TicketController@logout")->name('logout');

Route::get('/ticket', "\App\Http\Controllers\TicketController@create");

Route::get('/accept_call/{id}', "\App\Http\Controllers\TicketController@accept_call")->name('accept_call');

Route::get('/finish_call/{id}', "\App\Http\Controllers\TicketController@finish_call")->name('finish_call');

Route::post('/ticket_create', "\App\Http\Controllers\TicketController@store")->name('ticket_create');

Route::get('/call_lists', "\App\Http\Controllers\TicketController@index")->name('call_lists');

Route::get('/salespeople', "\App\Http\Controllers\SalesController@index")->name('salespeople');

Route::get('/sales_destroy/{id}', "\App\Http\Controllers\SalesController@destroy");

Route::get('/sales_create', "\App\Http\Controllers\SalesController@create")->name('sales_create');

Route::post('/sales_create', "\App\Http\Controllers\SalesController@store")->name('sales_create');

Route::post('/sales_update/{id}', "\App\Http\Controllers\SalesController@update")->name('sales_update');

Route::get('sales_edit/{id}', "\App\Http\Controllers\SalesController@edit")->name('sales_edit');

Route::get('ticket_view/{id}', "\App\Http\Controllers\TicketController@show")->name('ticket_view');

Route::post('/submit_login', "\App\Http\Controllers\TicketController@submit_login");




