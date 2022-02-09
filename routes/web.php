<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\BillController;


Route::get('error-conexion-db', function() {
    return view('errors.databaseConnectionError');
})->name('error.conexion.db');

Route::get('language/{lang?}', function($lang = 'en') {
    session()->put('language', $lang);
    return redirect('/');
})->name('language');

Route::match(['get', 'post'], 'login', [UserController::class, 'login'])->name('login');
Route::group(array('middleware' => array('auth')), function() {
	Route::get('/', [MainController::class, 'index'])->name('index');
	/* Users Routes */
	Route::get('users', [UserController::class, 'index'])->name('users');
	Route::get('loadUsers', [UserController::class, 'loadusers'])->name('users.loadusers');
	Route::get('createUser', [UserController::class, 'create'])->name('users.create');
    Route::post('storeUsers', [UserController::class, 'store'])->name('users.store');
    Route::get('editUsers/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('updateUsers', [UserController::class, 'update'])->name('users.update');
    Route::get('changeStatusUsers/{id}/{type}', [UserController::class, 'change_status'])->name('users.change_status');
     /* Products Routes */
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('loadproducts', [ProductController::class, 'loadproducts'])->name('products.loadproducts');
    Route::get('create', [ProductController::class, 'create'])->name('products.create');
    Route::post('store', [ProductController::class, 'store'])->name('products.store');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('update', [ProductController::class, 'update'])->name('products.update');
    Route::get('change_status/{id}/{type}', [ProductController::class, 'change_status'])->name('products.change_status');
    /* Shopping Routes */
    Route::get('shopping', [ShoppingController::class, 'index'])->name('shopping');
    Route::post('storeShopping', [ShoppingController::class, 'store'])->name('shopping.store');
    Route::get('loadshopping', [ShoppingController::class, 'loadshopping'])->name('shopping.loadshopping');
    Route::get('deleteShopping/{id}', [ShoppingController::class, 'delete_shopping'])->name('shopping.delete_shopping');
    /* Shopping Routes */
    Route::get('bill', [BillController::class, 'index'])->name('bill');
    Route::get('check_in', [BillController::class, 'check_in'])->name('bill.check_in');
    Route::get('loadBills', [BillController::class, 'loadBills'])->name('bill.loadBills');
    Route::get('show_bill/{id}', [BillController::class, 'show_bill'])->name('bill.show_bill');

	Route::get('logout', [UserController::class, 'logOut'])->name('logout');
    Route::get('theme/{theme?}', [UserController::class, 'theme'])->name('theme');
});