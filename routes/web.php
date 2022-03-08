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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/cms', function () {
        return view('cms');
    })->name('cms');

    Route::get('/gaming', function () {
        return redirect()->route('gaming.dashboard');
    })->name('gaming');

    Route::get('/gaming/dashboard', function () {
        return view('gaming.dashboard');
    })->name('gaming.dashboard');

    Route::get('/gaming/sessions', function () {
        return view('gaming.sessions');
    })->name('gaming.sessions');

    Route::get('/finance', function () {
        return redirect()->route('finance.transactions');
    })->name('finance');

    Route::get('/finance/transactions', function () {
        return view('finance.transactions');
    })->name('finance.transactions');

    Route::get('/customers', function () {
        return view('customers');
    })->name('customers');
});


