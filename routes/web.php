<?php


use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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
Route::match(["POST", "GET"], '/', [FrontController::class, 'home'])
    ->name('home');
Route::match(["POST", "GET"], '/join/{id}', [FrontController::class, 'join_us'])
    ->name('join_us');
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::match(["POST", "GET"], '/signin', [AuthController::class, 'signin'])
        ->name('signin');
    Route::match(["POST", "GET"], '/signin', [AuthController::class, 'signin'])
        ->name('signin');
    Route::match(["POST", "GET"], '/register', [AuthController::class, 'register'])
        ->name('register');
    Route::match(["POST", "GET"], '/d-register_driver', [AuthController::class, 'register_driver'])
        ->name('register_driver');
    Route::match(["POST", "GET"], '/email_verified', [AuthController::class, 'email_verified'])
        ->name('email_verified');
    Route::match(["POST", "GET"], '/sign_out', [AuthController::class, 'destroy'])
        ->name('sign_out');
    Route::match(["POST", "GET"], '/lock', [AuthController::class, 'lock'])
        ->name('lock');
});

Route::group(['prefix' => 'back', 'as' => 'back.','middleware' => ['isCustomer']], function () {
    Route::match(["POST", "GET"], '/dashboard', [FrontController::class, 'dashboard'])
        ->name('dashboard');

    Route::match(["POST", "GET"], '/sell_modal', [SettingController::class, 'sell_modal'])
        ->name('sell_modal');
    Route::match(["POST", "GET"], '/buy_modal', [SettingController::class, 'buy_modal'])
        ->name('buy_modal');
    Route::match(["POST", "GET"], '/exchange_modal', [SettingController::class, 'exchange_modal'])
        ->name('exchange_modal');
    Route::match(["POST", "GET"], '/withdraw', [PaymentController::class, 'withDrawModal'])
        ->name('withdraw');
    Route::match(["POST", "GET"], '/deposit', [PaymentController::class, 'deposit'])
        ->name('deposit');
});

Route::group(['prefix' => 'bk_admin', 'as' => 'admin.','middleware' => ['isAdmin']],function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('bc_dashboard');
    Route::get('/countries',[DashboardController::class,'countries'])
        ->name('bc_countries');
    Route::match(["POST", "GET"], '/countries/{id}',[DashboardController::class,'country_edit'])
        ->name('bc_country_id');
    Route::match(["POST", "GET"], '/countries/{id}/operators',[DashboardController::class,'country_operator'])
        ->name('bc_country_oparator');
    Route::get('/administrators',[UserController::class,'index'])
        ->name('bc_administrators');
    Route::get('/customers',[UserController::class,'customers'])
        ->name('bc_customers');
    Route::get('/transactions',[TransactionController::class,'transactions'])
        ->name('bc_transactions');
    Route::get('/cryptos',[DashboardController::class,'cryptos'])
        ->name('bc_cryptos');
    Route::get('/activeOrDesactive/{id}',[DashboardController::class,'activeOrDesactive'])
        ->name('bc_activeOrDesactive');

    Route::match(["POST", "GET"],'/profile',[DashboardController::class,'profil'])
        ->name('bc_profil');
});
