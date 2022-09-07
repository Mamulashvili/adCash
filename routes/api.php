<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Users - resource feature
    Route::prefix('users')->group(function () {
        Route::get('/get', [UserController::class, 'get'])->name('user.get');
    });
   Route::resource('/users', UserController::class, [
    'store', 'destroy', 'update', 'show'
   ]);

// Transactions - resource
   Route::resource('/transactions', TransactionsController::class, ['index','store', 'show']);
   Route::get('/transactions/user/{id}', [TransactionsController::class, 'transactionsByUser'])->name('transactions.byUser');

// Stocks - custom routes
Route::prefix('stock')->group(function () {
    Route::get('/', [StockController::class, 'get'])->name('stock.get');
    Route::put('/',  [StockController::class, 'update'])->name('stock.update');
    Route::delete('/{id}',  [StockController::class, 'destroy'])->name('stock.destroy');
    Route::post('/',  [StockController::class, 'store'])->name('stock.store');

    Route::get('/show/{id}', [StockController::class, 'show'])->name('stock.show');
    Route::get('/mostValuableStocks', [StockController::class, 'getMostValuableStocks'])->name('stock.valuable');
    Route::get('/recentStock', [StockController::class, 'getRecentStock'])->name('stock.recent');
});