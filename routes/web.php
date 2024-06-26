<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;

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

// naming route
// register
// login
// forgotPassword

// Route::get('/admin/register', function () {
//     return view('auth/register-admin');
// });

// Route::get('/admin/login', function () {
//     return view('auth/login-admin');
// });

// Route::get('/', function () {
//     return view('frontend.layout.header');
// });

Route::get('/',[FrontProductController::class,'index'])->name('home');
Route::get('/quote',[FrontProductController::class,'quote'])->name('quote');
Route::get('/quote/detail',[FrontProductController::class,'custQuote'])->name('custQuote');
Route::get('/quote/detail-total',[FrontProductController::class,'totalQuote'])->name('totalQuote');
Route::post('/quote/detail-total/store',[FrontProductController::class,'totalStore'])->name('totalStore');


// Route::get('signin',[LoginController::class,'index'])->name('login');

Route::group(['middleware' => ['BeforeLogin']], function () {
    Route::get('admin/login',[LoginController::class,'index'])->name('login');
    Route::post('admin/login',[LoginController::class,'loginProcess'])->name('loginProcess');

    // Verify OTP
    Route::get('admin/login/verify-otp',[LoginController::class,'verifyOtp'])->name('verifyOtp');
    Route::post('admin/login/verify-otp',[LoginController::class,'verifyOtpProcess'])->name('verifyOtpProcess');
});

Route::group(['middleware' => ['AfterLogin']], function () {
    Route::get('{slug}/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('logout',[LoginController::class,'logout'])->name('logout');

    Route::get('{slug}/product-view',[ProductController::class,'index'])->name('productView');
    Route::get('{slug}/product-add',[ProductController::class,'addProduct'])->name('addProduct');
    Route::post('product-store',[ProductController::class,'store'])->name('storeProduct');
    Route::get('{slug}/product-edit/{id}',[ProductController::class,'editProduct'])->name('editProduct');
    Route::post('/product-update',[ProductController::class,'update'])->name('updateProduct');
    Route::get('/product-delete/{id}',[ProductController::class,'delete'])->name('deleteProduct');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

    Route::get('{slug}/category-view',[CategoryController::class,'index'])->name('categoryView');
    Route::get('{slug}/category-add',[CategoryController::class,'addCategory'])->name('addCategory');
    Route::post('/category-store',[CategoryController::class,'store'])->name('storeCategory');
    Route::get('{slug}/category-edit/{id}',[CategoryController::class,'editCategory'])->name('editCategory');
    Route::post('/category-update',[CategoryController::class,'update'])->name('updateCategory');
    Route::get('/category-delete/{id}',[CategoryController::class,'delete'])->name('deleteCategory');


    Route::get('{slug}/size-view',[SizeController::class,'index'])->name('sizeView');
    Route::get('{slug}/size-add',[SizeController::class,'addSize'])->name('addSize');
    Route::post('product-size-store',[SizeController::class,'store'])->name('storeSize');
    Route::get('{slug}/size-edit/{id}',[SizeController::class,'editSize'])->name('editSize');
    Route::post('/product-size-update',[SizeController::class,'update'])->name('updateSize');
    Route::get('/product-size-delete/{id}',[SizeController::class,'delete'])->name('deleteSize');

    Route::get('{slug}/transaction-view',[TransactionController::class,'index'])->name('transactionView');




});

