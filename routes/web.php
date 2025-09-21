<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;




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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Admin-only
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);

    Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index')->middleware('auth');;
    Route::post('/borrow/{book}', [BorrowController::class, 'store'])->name('borrow.store');
    Route::put('/return/{borrow}', [BorrowController::class, 'return'])->name('borrow.return');
Route::put('/borrow/{borrowRecord}/return', [BorrowController::class, 'return'])->name('borrow.return');

});

require __DIR__.'/auth.php';
