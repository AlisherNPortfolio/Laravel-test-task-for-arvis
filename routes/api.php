<?php

use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReferencesController;
use Illuminate\Support\Facades\Route;

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

Route::resource('measure', MeasureController::class);
Route::resource('product', ProductController::class);
Route::resource('expenditure', ExpenditureController::class);

Route::get('products', [ReferencesController::class, 'getProducts']);
Route::get('measures', [ReferencesController::class, 'getMeasures']);
