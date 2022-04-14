<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Livewire\Finance\Transactions;
use App\Http\Livewire\Modals\AddComment;
use App\Http\Livewire\Modals\AddQuestion;
use App\Http\Livewire\Modals\ViewQuestion;
use App\Http\Livewire\Modals\EditQuestion;
use App\Http\Livewire\Modals\ConfirmDeleteQuestion;
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

    Route::get('/cms/questions', function () {
        return view('cms.questions');
    })->name('cms.questions');

    Route::get('/cms/dashboard', function () {
        return view('cms.dashboard');
    })->name('cms.dashboard');

    Route::get('/cms/question/view/{id}', ViewQuestion::class)->name('question.view');
    Route::post('/cms/question/edit', [EditQuestion::class, 'editQuestion']);
    Route::post('/cms/question/delete', [ConfirmDeleteQuestion::class, 'deleteQuestion']);
    Route::post('/cms/question/add', [AddQuestion::class, 'addQuestion']);
    Route::post('/cms/comment/add', [AddComment::class, 'addComment']);


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
    Route::get('/customers/dashboard', function () {
        return view('customers.dashboard');
    })->name('customers.dashboard');
});


