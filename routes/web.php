<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Livewire\Finance\Transactions;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['auth:sanctum', 'verified'], function () {
    Route::view('/cms', 'cms')->name('cms');
    Route::view('/gaming', 'gaming')->name('gaming');
    Route::view('/customers', 'customers')->name('customers');
    Route::redirect('/finance', '/finance/transactions')->name('finance');
    Route::view('/finance/transactions', 'finance.transactions')->name('finance.transactions');
});

