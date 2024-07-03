<?php

use App\Http\Controllers\ItemController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/new-arrival', [ItemController::class, 'newa'])->name('frame.newa');
Route::get('/best-seller', [ItemController::class, 'best'])->name('frame.best');
Route::get('/shirt', [ItemController::class, 'shirt'])->name('frame.shirt');
Route::get('/outwear', [ItemController::class, 'outwear'])->name('frame.outwear');
Route::get('/t-shirt', [ItemController::class, 'tshirt'])->name('frame.tshirt');
Route::get('/pants', [ItemController::class, 'pants'])->name('frame.pants');
Route::get('/detail', [ItemController::class, 'detail'])->name('frame.detail');
