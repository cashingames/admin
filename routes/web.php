<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Livewire\Cms\CategoryManager;
use App\Http\Livewire\Finance\Transactions;
use App\Http\Livewire\Modals\AddComment;
use App\Http\Livewire\Modals\AddQuestion;
use App\Http\Livewire\Modals\ViewQuestion;
use App\Http\Livewire\Modals\EditQuestion;
use App\Http\Livewire\Modals\ConfirmDeleteQuestion;
use App\Http\Livewire\Modals\EditApprovedQuestion;
use App\Http\Livewire\Modals\EditCategory;
use App\Http\Livewire\Modals\EditRejectedQuestion;

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
        return redirect()->route('cms.dashboard');
    })->name('cms');

    Route::get('/cms/categories', function () {
        return view('cms');
    })->name('cms.categories');

    Route::get('/cms/questions/unreviewed', function () {
        return view('cms.unreviewedQuestions');
    })->name('cms.unreviewedQuestions');

    Route::get('/cms/questions/approved', function () {
        return view('cms.approvedQuestions');
    })->name('cms.approvedQuestions');

    Route::get('/cms/questions/rejected', function () {
        return view('cms.rejectedQuestions');
    })->name('cms.rejectedQuestions');

    Route::get('/cms/questions/published', function () {
        return view('cms.publishedQuestions');
    })->name('cms.publishedQuestions');

    Route::get('/cms/dashboard', function () {
        return view('cms.dashboard');
    })->name('cms.dashboard');

    Route::get('/cms/question/view/{id}', ViewQuestion::class)->name('question.view');
    Route::post('/cms/question/edit', [EditQuestion::class, 'editQuestion']);
    Route::post('/cms/approved-question/edit', [EditApprovedQuestion::class, 'editQuestion']);
    Route::post('/cms/rejected-question/edit', [EditRejectedQuestion::class, 'editQuestion']);
    Route::post('/cms/question/delete', [ConfirmDeleteQuestion::class, 'deleteQuestion']);
    Route::post('/cms/question/add', [AddQuestion::class, 'addQuestion']);
    Route::post('/cms/comment/add', [AddComment::class, 'addComment']);
    Route::post('/cms/category/add', [CategoryManager::class, 'addCategory']);
    Route::post('/cms/category/edit', [EditCategory::class, 'editCategory']);


    Route::get('/gaming', function () {
        return redirect()->route('gaming.dashboard');
    })->name('gaming');

    Route::get('/gaming/dashboard', function () {
        return view('gaming.dashboard');
    })->name('gaming.dashboard');

    Route::get('/gaming/exhibition/sessions', function () {
        return view('gaming.exhibition.sessions');
    })->name('gaming.sessions');

    Route::get('/gaming/challenge/sessions', function () {
        return view('gaming.challenge.challengeGameSessions');
    })->name('gaming.challengeGameSessions');

    Route::get('/gaming/live-trivia/sessions', function () {
        return view('gaming.livetrivia.triviaGameSessions');
    })->name('gaming.triviaGameSessions');
 
 
    Route::get('/gaming/trivia', function () {
        return view('gaming.livetrivia.trivia');
    })->name('gaming.trivia');

    Route::get('/gaming/challenges', function () {
        return view('gaming.challenge.challenges');
    })->name('gaming.challenges');

    Route::get('/gaming/odds', function () {
        return view('gaming.odds.odds');
    })->name('gaming.odds');

    Route::get('/staking/odds', function () {
        return view('gaming.odds.stakingOdds');
    })->name('gaming.stakingOdds');

    Route::get('/gaming/stakings', function () {
        return view('gaming.staking.stakings');
    })->name('gaming.stakings');

    Route::get('/gaming/challenges/data', function () {
        return view('gaming.challenge.challengeUserData');
    })->name('gaming.challengeUserData');

    Route::get('/gaming/trivia/create', function () {
        return view('gaming.livetrivia.add-trivia');
    })->name('trivia.create');

    Route::get('/gaming/trivia/select-questions/{id}', function () {
        return view('gaming.livetrivia.select-questions');
    })->name('trivia.select-questions');

    Route::get('/gaming/trivia/edit/{id}', function () {
        return view('gaming.livetrivia.edit-trivia');
    })->name('trivia.edit');

    Route::get('/finance', function () {
        return redirect()->route('finance.transactions');
    })->name('finance');

    Route::get('/finance/transactions', function () {
        return view('finance.transactions');
    })->name('finance.transactions');

    Route::get('/finance/wallets', function () {
        return view('finance.wallets');
    })->name('finance.wallets');

    Route::get('/finance/transactions/wallet-funds', function () {
        return view('finance.fundTransactions');
    })->name('finance.fundings');

    Route::get('/finance/transactions/withdrawals', function () {
        return view('finance.withdrawalTransactions');
    })->name('finance.withdrawals');

    Route::get('/finance/dashboard', function () {
        return view('finance.dashboard');
    })->name('finance.dashboard');

    Route::get('/customers', function () {
        return redirect()->route('customers.dashboard');
    })->name('customers');

    Route::get('/customers/list', function () {
        return view('customers');
    })->name('customers.list');

    Route::get('customers/general/data', function () {
        return view('customers.generalData');
    })->name('customers.general.data');

    Route::get('/customers/dashboard', function () {
        return view('customers.dashboard');
    })->name('customers.dashboard');
});


