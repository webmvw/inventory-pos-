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
	});

});
