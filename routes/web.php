<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Models\product;
use Illuminate\Http\Request;
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
Route::get('/outwear', [ItemController::class, 'outwear'])->name('frame.outwear');
Route::get('/t-shirt', [ItemController::class, 'tshirt'])->name('frame.tshirt');
Route::get('/pants', [ItemController::class, 'pants'])->name('frame.pants');

Route::get('/shirt', [ProductController::class, 'index'])->name('frame.shirt');
Route::get('/shirt/{code}', [ProductController::class, 'detail'])->name('frame.detail');

// Route::get('/api/colors', function (Request $request) {
//     $code = $request->input('code');
//     $size = $request->input('size');

//     $colors = product::where('code', 'like', substr($code, 0, 6) . '%')
//         ->where('size', $size)
//         ->pluck('color');

//     return response()->json($colors);
// });

Route::get('/cart', [ProductController::class, 'cart'])->name('frame.cart');
Route::get('/check-product', [ProductController::class, 'checkProductAvailability'])->name('check-product');
