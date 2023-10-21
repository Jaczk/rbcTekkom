<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DonateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\SpecDetailController;
use App\Http\Controllers\Admin\SpecializationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/chart/ajax/{period}', [DashboardController::class, 'procurementChartAjax'])->name('admin.chart.ajax');
Route::get('/itemChart/ajax/{period}', [DashboardController::class, 'itemLoanChartAjax'])->name('admin.itemchart.ajax');

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name('admin.login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'fine'], function () {
    Route::get('/', [FineController::class, 'index'])->name('admin.fine');
    Route::get('/edit', [FineController::class, 'edit'])->name('admin.fine.edit');
    Route::put('/update', [FineController::class, 'update'])->name('admin.fine.update');
});

Route::group(['prefix' => 'book'], function () {
    Route::get('/', [BookController::class, 'index'])->name('admin.book');
    Route::get('/create', [BookController::class, 'create'])->name('admin.book.create');
    Route::post('/store', [BookController::class, 'store'])->name('admin.book.store');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('admin.book.edit');
    Route::put('/update/{id}', [BookController::class, 'update'])->name('admin.book.update');
    Route::delete('/destroy/{id}', [BookController::class, 'destroy'])->name('admin.book.destroy');
    // Route::get('/trash', [GoodController::class, 'trash'])->name('admin.good.trash');
    // Route::put('/restore/{id}', [GoodController::class, 'restore'])->name('admin.good.restore');
    // Route::delete('/delete/{id}', [GoodController::class, 'forceDelete'])->name('admin.good.delete');
});

Route::group(['prefix' => 'loans'], function () {
    Route::get('/', [LoanController::class, 'index'])->name('admin.loans');
    Route::put('/return/{id}', [LoanController::class, 'return'])->name('admin.loans.return');
    Route::get('/chart/loan/{period}', [LoanController::class, 'loanChartAjax'])->name('admin.chart.loan.ajax');
    Route::delete('/destroy/{id}', [LoanController::class, 'destroy'])->name('admin.loans.destroy');
});

Route::group(['prefix' => 'donate'], function () {
    Route::get('/', [DonateController::class, 'index'])->name('admin.donate');
    Route::get('/edit', [DonateController::class, 'edit'])->name('admin.donate.edit');
    Route::put('/update', [DonateController::class, 'update'])->name('admin.donate.update');
});

Route::group(['prefix' => 'publisher'], function () {
    Route::get('/', [PublisherController::class, 'index'])->name('admin.publisher');
    Route::get('/edit', [PublisherController::class, 'edit'])->name('admin.publisher.edit');
    Route::put('/update', [PublisherController::class, 'update'])->name('admin.publisher.update');
});

Route::group(['prefix' => 'special'], function () {
    Route::get('/', [SpecializationController::class, 'index'])->name('admin.special');
    Route::get('/edit', [SpecializationController::class, 'edit'])->name('admin.special.edit');
    Route::put('/update', [SpecializationController::class, 'update'])->name('admin.special.update');
});

Route::group(['prefix' => 'specDetail'], function () {
    Route::get('/', [SpecDetailController::class, 'index'])->name('admin.specDetail');
    Route::get('/edit', [SpecDetailController::class, 'edit'])->name('admin.specDetail.edit');
    Route::put('/update', [SpecDetailController::class, 'update'])->name('admin.specDetail.update');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.user');
    Route::get('/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/update', [UserController::class, 'update'])->name('admin.user.update');
});