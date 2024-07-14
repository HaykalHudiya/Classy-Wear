<?php

use App\Http\Controllers\InvoiceController;
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
// Route::get('/new-arrival', [ItemController::class, 'newa'])->name('frame.newa');
// Route::get('/best-seller', [ItemController::class, 'best'])->name('frame.best');
// Route::get('/outwear', [ItemController::class, 'outwear'])->name('frame.outwear');
// Route::get('/t-shirt', [ItemController::class, 'tshirt'])->name('frame.tshirt');
// Route::get('/pants', [ItemController::class, 'pants'])->name('frame.pants');

Route::get('/search', [ProductController::class, 'indexs'])->name('search');
Route::get('/shirt/shirt', [ProductController::class, 'cart'])->name('cart');

// Route::get('/api/colors', function (Request $request) {
//     $code = $request->input('code');
//     $size = $request->input('size');

//     $colors = product::where('code', 'like', substr($code, 0, 6) . '%')
//         ->where('size', $size)
//         ->pluck('color');

//     return response()->json($colors);
// });

// Route::match(['get', 'post'], '/cart', [ProductController::class, 'cart'])->name('cart');

Route::match(['get', 'post'], '/carts', [InvoiceController::class, 'checkout'])->name('carts');
Route::post('/clear-session', [InvoiceController::class, 'clearSession'])->name('clearSession');
Route::post('/rollback-transaction', [InvoiceController::class, 'rollbackTransaction'])->name('rollbackTransaction');
// Route::get('/carts/checkout', [InvoiceController::class, 'rollbackTransaction'])->name('rollbackTransaction');
Route::post('/checkout-callback', [InvoiceController::class, 'callback']);
// Route::post('/carts', [InvoiceController::class, 'checkout']);
// Route::post('/carts/pay', [InvoiceController::class, 'checkout'])->name('carts.pay');
// Route::post('/cart/add', [ProductController::class, 'addToCart']);
Route::post('/cart/add', [ProductController::class, 'addToCart']);
Route::post('/carts/remove', [ProductController::class, 'removeFromCart']);
Route::get('/check-product', [ProductController::class, 'checkProductAvailability'])->name('check-product');
Route::get('/detail/{code}', [ProductController::class, 'detail'])->name('frame.detail');
Route::get('/{category}', [ProductController::class, 'index'])->name('frame.{category}');
