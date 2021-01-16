<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){

	// suppliers routes
	Route::group(['prefix' => 'suppliers'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\SupplierController::class, 'view'])->name('suppliers.view');
		Route::get('/add', [App\Http\Controllers\Admin\SupplierController::class, 'add'])->name('suppliers.add');
		Route::post('/store', [App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('suppliers.store');
		Route::get('/edit/{id}', [App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('suppliers.edit');
		Route::post('/update/{id}', [App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('suppliers.update');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\SupplierController::class, 'delete'])->name('suppliers.delete');
	});


	// customers routes
	Route::group(['prefix' => 'customers'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\CustomerController::class, 'view'])->name('customers.view');
		Route::get('/add', [App\Http\Controllers\Admin\CustomerController::class, 'add'])->name('customers.add');
		Route::post('/store', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customers.store');
		Route::get('/edit/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customers.edit');
		Route::post('/update/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customers.update');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'delete'])->name('customers.delete');
	});

});
