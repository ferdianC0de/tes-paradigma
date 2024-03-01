<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CatergoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('category', [CatergoryController::class, 'index'])->name('category.index');
    Route::get('category/{id}', [CatergoryController::class, 'show'])->name('category.show');
    Route::post('category', [CatergoryController::class, 'store'])->name('category.store');
    Route::put('category', [CatergoryController::class, 'update'])->name('category.update');
    Route::delete('category', [CatergoryController::class, 'destroy'])->name('category.delete');

    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('product', [ProductController::class, 'store'])->name('product.store');
    Route::put('product', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product', [ProductController::class, 'destroy'])->name('product.delete');
});
