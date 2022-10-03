<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\FrontEnd\CategoryController as FrontEndCategoryController;
use App\Http\Controllers\FrontEnd\MenuController as FrontEndMenuController;
use App\Http\Controllers\FrontEnd\ReservationController as FrontEndReservationController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/categories', [FrontEndCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [FrontEndCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [FrontEndMenuController::class, 'index'])->name('menus.index');
Route::get('/reservations/step-one', [FrontEndReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::get('/reservations/step-two', [FrontEndReservationController::class, 'stepTwo'])->name('reservations.step.two');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservations', ReservationController::class);
});

require __DIR__.'/auth.php';
