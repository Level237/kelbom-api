<?php


use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;


Route::domain(config('app.seller_domain'))->group(function () {
    Route::get('/', function () {
        return view('seller.homepage');
    });

    Route::get('/access-route', [AuthController::class, 'getAccessRoute'])->name('seller.access-route');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('seller.register');
    Route::post('/register', [AuthController::class, 'register'])->name('seller.register.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Création de stand — public (sans auth)
    Route::get('/create', [StandController::class, 'create'])->name('seller.create');
    Route::post('/create', [StandController::class, 'store'])->name('seller.create.store');
    Route::get('/stand/create', [StandController::class, 'create'])->name('seller.stand.create');
    Route::post('/stand/create', [StandController::class, 'store'])->name('seller.stand.store');
    Route::get('/geocode/reverse', [StandController::class, 'reverseGeocode'])->name('seller.geocode.reverse');

    Route::middleware(['auth', 'seller.role'])->group(function () {
        Route::middleware('seller.stand')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');

            Route::prefix('products')->name('seller.products.')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/', [ProductController::class, 'store'])->name('store');
                Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('/{product}', [ProductController::class, 'update'])->name('update');
                Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('stand')->name('seller.stand.')->group(function () {
                Route::get('/edit', [StandController::class, 'edit'])->name('edit');
                Route::put('/', [StandController::class, 'update'])->name('update');
                Route::get('/preview', [StandController::class, 'show'])->name('preview');
            });

            Route::get('/loading', [\App\Http\Controllers\Seller\LoadingStandController::class, 'index'])->name('seller.loading-stand');
        });
    });
});
