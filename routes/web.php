<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Cms\CategoryManager;
use App\Http\Livewire\Cms\GameArk\CategoryManager As GameArkCategoryManager;
use App\Http\Livewire\Modals\EditQuestion;
use App\Http\Livewire\Modals\ConfirmDeleteQuestion;
use App\Http\Livewire\Modals\EditCategory;
use App\Http\Livewire\Modals\EditGameArkCategory;

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

    Route::get('/cms/gameark/categories', function () {
        return view('cms.gameark.categories');
    })->name('cms.gameark-categories');

    Route::get('/cms/questions/upload', function () {
        return view('cms.upload-questions');
    })->name('cms.uploadQuestions');

    Route::get('/cms/questions/published', function () {
        return view('cms.publishedQuestions');
    })->name('cms.publishedQuestions');

    Route::get('/cms/gameark/questions/published', function () {
        return view('cms.gameark.publishedQuestions');
    })->name('cms.gameark.publishedQuestions');

    Route::get('/cms/dashboard', function () {
        return view('cms.dashboard');
    })->name('cms.dashboard');

    Route::get('/cms/gameark/stats', function () {
        return view('cms.gameark.stats');
    })->name('cms.gameark-stats');

    Route::post('/cms/question/edit', [EditQuestion::class, 'editQuestion']);
    Route::post('/cms/question/delete', [ConfirmDeleteQuestion::class, 'deleteQuestion']);
    Route::post('/cms/category/add', [CategoryManager::class, 'addCategory']);
    Route::post('/cms/gameark/category/add', [GameArkCategoryManager::class, 'addCategory']);
    Route::post('/cms/category/edit', [EditCategory::class, 'editCategory']);
    Route::post('/cms/gameark/category/edit', [EditGameArkCategory::class, 'editCategory']);


    Route::get('/gaming', function () {
        return redirect()->route('gaming.challenges');
    })->name('gaming');

    Route::get('/gaming/dashboard', function () {
        return redirect()->route('gaming.challenges');
    })->name('gaming.dashboard');

    Route::get('/gaming/exhibition/sessions', function () {
        return view('gaming.exhibition.sessions');
    })->name('gaming.sessions');

    Route::get('/gameark/sessions', function () {
        return view('gaming.gameark.sessions');
    })->name('gameark.sessions');

    Route::get('/gaming/user-achievement-badges', function () {
        return view('gaming.userAchievementBadges');
    })->name('gaming.userAchievementBadges');

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

    Route::get('/cashingames/users/edit/{id}', function () {
        return view('customers.edit-details');
    })->name('customers.edit');

    Route::get('/gaming/session/details', function () {
        return view('gaming.session-details');
    })->name('session.details');

    Route::get('/finance', function () {
        return redirect()->route('finance.transactions');
    })->name('finance');

    Route::get('/finance/transactions', function () {
        return view('finance.transactions');
    })->name('finance.transactions');

    Route::get('/finance/wallets', function () {
        return view('finance.wallets');
    })->name('finance.wallets');

    Route::get('/finance/pay', function () {
        return view('finance.pay');
    })->name('finance.fund');

    Route::get('/finance/transactions/wallet-funds', function () {
        return view('finance.fundTransactions');
    })->name('finance.fundings');

    Route::get('/finance/transactions/withdrawals', function () {
        return view('finance.withdrawalTransactions');
    })->name('finance.withdrawals');
    
    Route::get('/finance/dashboard', function () {
        return redirect()->route('finance.transactions');
    })->name('finance.dashboard');

    Route::get('/customers', function () {
        return redirect()->route('customers.list');
    })->name('customers');

    Route::get('/customers/list', function () {
        return view('customers');
    })->name('customers.list');

    Route::get('/cashingames/customers/deactivated', function () {
        return view('customers.cashingamesDeactivatedUsers');
    })->name('customers.deactivated');

    Route::get('/gameark/customers/list', function () {
        return view('customers.gamearkCustomers');
    })->name('gameark-customers.list');

    Route::get('customers/general/data', function () {
        return view('customers.generalData');
    })->name('customers.general.data');

    Route::get('gameark/customers/general/data', function () {
        return view('customers.gamearkGeneralData');
    })->name('gameark-customers.general.data');

    Route::get('/customers/dashboard', function () {
        return redirect()->route('customers.list');
    })->name('customers.dashboard');
});


