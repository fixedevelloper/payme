<?php

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
Route::post('create_account', [SecurityController::class, 'create']);
Route::get('countries', [StaticController::class, 'countries']);
Route::get('countries/{id}', [StaticController::class, 'countriesby_id']);
Route::post('transactions/mobile', [TransactionController::class, 'cashOut']);
Route::post('transactions/mobile/deposit', [TransactionController::class, 'cashIn']);
Route::get('transactions/{id}/lists', [TransactionController::class, 'transactions']);
Route::get('transactions/{id}/lasts', [TransactionController::class, 'last_transactions']);
Route::get('accounts/{id}', [SecurityController::class, 'getAccount']);


