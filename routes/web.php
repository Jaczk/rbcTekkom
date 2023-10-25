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
    // Route::get('/', [FineController::class, 'index'])->name('admin.fine');
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
    Route::get('/create', [LoanController::class, 'create'])->name('admin.loans.create');
    Route::post('/store', [LoanController::class, 'store'])->name('admin.loans.store');
    Route::put('/return/{id}', [LoanController::class, 'return'])->name('admin.loans.return');
    Route::get('/chart/loan/{period}', [LoanController::class, 'loanChartAjax'])->name('admin.chart.loan.ajax');
    Route::delete('/destroy/{id}', [LoanController::class, 'destroy'])->name('admin.loans.destroy');
});

Route::group(['prefix' => 'donate'], function () {
    Route::get('/', [DonateController::class, 'index'])->name('admin.donate');
    Route::get('/edit/{id}', [DonateController::class, 'edit'])->name('admin.donate.edit');
    Route::put('/update/{id}', [DonateController::class, 'update'])->name('admin.donate.update');
});

Route::group(['prefix' => 'special'], function () {
    Route::get('/', [SpecializationController::class, 'index'])->name('admin.special');
    Route::get('/create', [SpecializationController::class, 'create'])->name('admin.special.create');
    Route::get('/edit/{id}', [SpecializationController::class, 'edit'])->name('admin.special.edit');
    Route::post('/store', [SpecializationController::class, 'store'])->name('admin.special.store');
    Route::put('/update/{id}', [SpecializationController::class, 'update'])->name('admin.special.update');
    Route::delete('/destroy/{id}', [SpecializationController::class, 'destroy'])->name('admin.special.destroy');
});

Route::group(['prefix' => 'specDetail'], function () {
    Route::get('/', [SpecDetailController::class, 'index'])->name('admin.specDetail');
    Route::get('/edit/{id}', [SpecDetailController::class, 'edit'])->name('admin.specDetail.edit');
    Route::post('/store', [SpecDetailController::class, 'store'])->name('admin.specDetail.store');
    Route::get('/create', [SpecDetailController::class, 'create'])->name('admin.specDetail.create');
    Route::put('/update/{id}', [SpecDetailController::class, 'update'])->name('admin.specDetail.update');
    Route::delete('/destroy/{id}', [SpecDetailController::class, 'destroy'])->name('admin.specDetail.destroy');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.user');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});