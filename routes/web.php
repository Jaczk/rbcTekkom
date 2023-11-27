  <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\BookController;
    use App\Http\Controllers\Admin\BookLabelController;
    use App\Http\Controllers\Admin\FineController;
    use App\Http\Controllers\Admin\LoanController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\User\LoginController;
    use App\Http\Controllers\User\RegisterController;
    use App\Http\Controllers\User\HomeController;
    use App\Http\Controllers\Admin\DonateController;
    use App\Http\Controllers\Admin\LibrarianController;
    use App\Http\Controllers\User\LibrarianController as UserLibrarianController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\User\DonateController as UserDonateController;
    use App\Http\Controllers\Admin\FacilityController;
    use App\Http\Controllers\User\FacilityController as UserFacilityController;
    use App\Http\Controllers\Admin\ShiftController;
    use App\Http\Controllers\User\ShiftController as UserShiftController;
    use App\Http\Controllers\Admin\TextEditController;
    use App\Http\Controllers\User\TextEditController as UserTextEditController;
    use App\Http\Controllers\Admin\SpecDetailController;
    use App\Http\Controllers\Admin\SpecializationController;
    use App\Http\Controllers\User\CatalogController;
    use App\Http\Controllers\User\SpecBookController;


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

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/access', [HomeController::class, 'access'])->name('access');
    Route::get('/show/{id}', [HomeController::class, 'show'])->name('book.show');

    Route::get('/catalog', [CatalogController::class, 'index'])->name('user.catalog');
    Route::get('/donations', [UserDonateController::class, 'index'])->name('user.donate');
    Route::get('/show-donate/{id}', [UserDonateController::class, 'show'])->name('user.donate.show');
    Route::get('/librarians', [UserLibrarianController::class, 'index'])->name('user.librarian');

    //Shift
    Route::get('/shift', [UserShiftController::class, 'index'])->name('user.shift');
    Route::get('/faq', [UserTextEditController::class, 'faq'])->name('user.faq');
    Route::get('/visi-misi', [UserTextEditController::class, 'visi'])->name('user.visi');
    Route::get('/rule', [UserTextEditController::class, 'rule'])->name('user.rule');

    //Fasilitas
    Route::get('/gallery', [UserFacilityController::class, 'gallery'])->name('user.gallery');

    //Auth
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('auth/login', [LoginController::class, 'authenticate'])->name('login.auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    //byCategoryPage
    Route::get('/specBook', [SpecBookController::class, 'index'])->name('user.specBook');
    Route::get('/book-spec/{id}', [SpecBookController::class, 'sortedBySpec'])->name('user.book.spec');

    //Admin Area
    Route::group(['prefix' => 'admin', 'middleware' => ['user.auth', 'user.acc:1']], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Route::get('/chart/ajax/{period}', [DashboardController::class, 'procurementChartAjax'])->name('admin.chart.ajax');
        Route::get('/specChart/ajax/{period}', [DashboardController::class, 'specBookChartAjax'])->name('admin.specChart.ajax');

        Route::group(['prefix' => 'book'], function () {
            Route::get('/', [BookController::class, 'index'])->name('admin.book');
            Route::get('/create', [BookController::class, 'create'])->name('admin.book.create');
            Route::post('/store', [BookController::class, 'store'])->name('admin.book.store');
            Route::get('/edit/{id}', [BookController::class, 'edit'])->name('admin.book.edit');
            Route::get('/show/{id}', [BookController::class, 'show'])->name('admin.book.show');
            Route::put('/update/{id}', [BookController::class, 'update'])->name('admin.book.update');
            Route::delete('/destroy/{id}', [BookController::class, 'destroy'])->name('admin.book.destroy');
        });

        Route::group(['prefix' => 'bookLabel'], function () {
            Route::get('/generate-all-label', [BookLabelController::class, 'generateAllBookLabels'])->name('admin.bookLabel.generateAllBookLabels');
            Route::post('/generate-all-label', [BookLabelController::class, 'generateAllBookLabels']); // Add a POST route for the same action
            Route::get('/generate-label/{bookId}', [BookLabelController::class, 'generateLabel'])->name('admin.bookLabel.generateLabel');
        });

        Route::group(['prefix' => 'loans'], function () {
            Route::get('/', [LoanController::class, 'index'])->name('admin.loans');
            Route::get('/create', [LoanController::class, 'create'])->name('admin.loans.create');
            Route::get('/QRcreate', [LoanController::class, 'QRcreate'])->name('admin.loans.qr-create');
            Route::post('/store', [LoanController::class, 'store'])->name('admin.loans.store');
            Route::post('/QRstore', [LoanController::class, 'QRstore'])->name('admin.loans.QRstore');
            Route::put('/return/{id}', [LoanController::class, 'return'])->name('admin.loans.return');
            Route::get('/chart/loan/{period}', [LoanController::class, 'loanChartAjax'])->name('admin.chart.loan.ajax');
            Route::delete('/destroy/{id}', [LoanController::class, 'destroy'])->name('admin.loans.destroy');
        });

        Route::group(['prefix' => 'donate'], function () {
            Route::get('/', [DonateController::class, 'index'])->name('admin.donate');
            Route::get('/create', [DonateController::class, 'create'])->name('admin.donate.create');
            Route::post('/store', [DonateController::class, 'store'])->name('admin.donate.store');
            Route::get('/edit/{id}', [DonateController::class, 'edit'])->name('admin.donate.edit');
            Route::get('/show/{id}', [DonateController::class, 'show'])->name('admin.donate.show');
            Route::put('/update/{id}', [DonateController::class, 'update'])->name('admin.donate.update');
            Route::delete('/destroy/{id}', [DonateController::class, 'destroy'])->name('admin.donate.destroy');
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

        Route::group(['prefix' => 'fine'], function () {
            Route::get('/edit', [FineController::class, 'edit'])->name('admin.fine.edit');
            Route::put('/update', [FineController::class, 'update'])->name('admin.fine.update');
        });

        Route::group(['prefix' => 'facility'], function () {
            Route::get('/gallery', [FacilityController::class, 'gallery'])->name('admin.facility.gallery');
            Route::get('/gallery/edit/{id}', [FacilityController::class, 'editGallery'])->name('admin.facility.gallery.edit');
            Route::put('/gallery/update/{id}', [FacilityController::class, 'updateGallery'])->name('admin.facility.gallery.update');
            Route::get('/gallery/create', [FacilityController::class, 'create'])->name('admin.facility.gallery.create');
            Route::post('/gallery/store', [FacilityController::class, 'store'])->name('admin.facility.gallery.store');
            Route::get('/gallery/destroy/{id}', [FacilityController::class, 'destroy'])->name('admin.facility.gallery.destroy');
        });

        Route::group(['prefix' => 'shift'], function () {
            Route::get('/', [ShiftController::class, 'index'])->name('admin.shift');
            Route::get('/edit/{id}', [ShiftController::class, 'edit'])->name('admin.shift.edit');
            Route::get('/edit-time', [ShiftController::class, 'editTime'])->name('admin.shift.editTime');
            Route::put('/update/{id}', [ShiftController::class, 'update'])->name('admin.shift.update');
            Route::put('/update-time', [ShiftController::class, 'updateTime'])->name('admin.shift.updateTime');
        });

        Route::group(['prefix' => 'textEdit'], function () {
            Route::get('/', [TextEditController::class, 'index'])->name('admin.text');
            Route::get('/edit/{id}', [TextEditController::class, 'edit'])->name('admin.text.edit');
            Route::put('/update/{id}', [TextEditController::class, 'update'])->name('admin.text.update');
        });

        Route::group(['prefix' => 'librarian'], function () {
            Route::get('/', [LibrarianController::class, 'index'])->name('admin.librarian');
            Route::get('/create', [LibrarianController::class, 'create'])->name('admin.librarian.create');
            Route::post('/store', [LibrarianController::class, 'store'])->name('admin.librarian.store');
            Route::get('/edit/{id}', [LibrarianController::class, 'edit'])->name('admin.librarian.edit');
            Route::put('/update/{id}', [LibrarianController::class, 'update'])->name('admin.librarian.update');
            Route::delete('/destroy/{id}', [LibrarianController::class, 'destroy'])->name('admin.librarian.destroy');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });
    });
