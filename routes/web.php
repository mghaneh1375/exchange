<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TelegramBotController;
use Illuminate\Support\Facades\Route;

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

	
Route::get('/updated-activity', [TelegramBotController::class, 'updatedActivity']);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [AuthController::class, 'dashboard']);

Route::get('/', [CurrencyController::class, 'home']);

Route::get('/price/get', [CurrencyController::class, 'getPrice'])->name('getPrice');

Route::get('/new-design', [CurrencyController::class, 'home2'])->name('home2');

Route::get('/new-success/{request}', [RequestController::class, 'success'])->name('new-success');

Route::get('/err', [RequestController::class, 'err'])->name('err');

Route::get('/success/{request}', [RequestController::class, 'success'])->name('success');

Route::post('submitOrder', [RequestController::class, 'store'])->name('submitOrder');

Route::post('update-price', [CurrencyController::class, 'update'])->name('updatePrice');