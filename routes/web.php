<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransactionController;



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
Route::get('/deposit', function () {
    return view('deposit');
})->middleware('auth');

Route::post('deposit/verify', [DepositController::class, 'createDeposit'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/admin',[TransactionController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');



require __DIR__.'/auth.php';
