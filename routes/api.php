<?php

use App\Http\Controllers\API\BeneficiaryController;
use App\Http\Controllers\API\SecurityController;
use App\Http\Controllers\API\StaticController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('authenticate', [SecurityController::class, 'authenticate']);
Route::get('accounts/customer/{id}', [SecurityController::class, 'getCustomerAccount']);
Route::get('accounts/search', [SecurityController::class, 'searchAccount']);
Route::post('create_account', [SecurityController::class, 'create']);
Route::get('countries', [StaticController::class, 'countries']);
Route::get('banners', [StaticController::class, 'banners']);
Route::get('countries/{id}', [StaticController::class, 'countriesby_id']);
Route::get('countries/{id}/one', [StaticController::class, 'getOnecountries']);
Route::get('banks/{id}', [StaticController::class, 'getBankCountry']);
Route::post('transactions/mobile', [TransactionController::class, 'cashOut']);
Route::post('transactions/bank', [TransactionController::class, 'cashOutBank']);
Route::post('transactions/wallet', [TransactionController::class, 'cashOutWallet']);
Route::post('transactions/mobile/deposit', [TransactionController::class, 'cashIn']);
Route::get('transactions/{id}/lists', [TransactionController::class, 'transactions']);
Route::get('transactions/{id}/lasts', [TransactionController::class, 'last_transactions']);
Route::get('accounts/{id}', [SecurityController::class, 'getAccount']);
Route::get('payment_links/{id}/lists', [TransactionController::class, 'payment_links']);
Route::post('payment_links', [TransactionController::class, 'create_paymentlink']);
Route::post('beneficiaries', [BeneficiaryController::class, 'createBeneficiary']);
Route::get('beneficiaries/{id}/lists', [BeneficiaryController::class, 'getAllBeneficiaries']);


