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
		Route::get('/credit', [App\Http\Controllers\Admin\CustomerController::class, 'creditCustomer'])->name('customers.credit');
		Route::get('/credit/pdf', [App\Http\Controllers\Admin\CustomerController::class, 'creditCustomerPdf'])->name('customers.credit.pdf');
		Route::get('/credit/invoiceEdit/{invoice_id}', [App\Http\Controllers\Admin\CustomerController::class, 'creditCustomerInvoiceEdit'])->name('creditCustomer_invoiceEdit');
		Route::post('/credit/invoiceUpdate/{invoice_id}', [App\Http\Controllers\Admin\CustomerController::class, 'creditCustomerInvoiceUpdate'])->name('creditCustomer_invoiceUpdate');

	});



	// units routes
	Route::group(['prefix' => 'units'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\UnitController::class, 'view'])->name('units.view');
		Route::get('/add', [App\Http\Controllers\Admin\UnitController::class, 'add'])->name('units.add');
		Route::post('/store', [App\Http\Controllers\Admin\UnitController::class, 'store'])->name('units.store');
		Route::get('/edit/{id}', [App\Http\Controllers\Admin\UnitController::class, 'edit'])->name('units.edit');
		Route::post('/update/{id}', [App\Http\Controllers\Admin\UnitController::class, 'update'])->name('units.update');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\UnitController::class, 'delete'])->name('units.delete');
	});


	// categorys routes
	Route::group(['prefix' => 'categorys'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\CategoryController::class, 'view'])->name('categorys.view');
		Route::get('/add', [App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('categorys.add');
		Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categorys.store');
		Route::get('/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categorys.edit');
		Route::post('/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categorys.update');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('categorys.delete');
	});


	// products routes
	Route::group(['prefix' => 'products'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\ProductController::class, 'view'])->name('products.view');
		Route::get('/add', [App\Http\Controllers\Admin\ProductController::class, 'add'])->name('products.add');
		Route::post('/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
		Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
		Route::post('/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('products.delete');
	});



	// purchases routes
	Route::group(['prefix' => 'purchases'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\PurchaseController::class, 'view'])->name('purchases.view');
		Route::get('/add', [App\Http\Controllers\Admin\PurchaseController::class, 'add'])->name('purchases.add');
		Route::post('/store', [App\Http\Controllers\Admin\PurchaseController::class, 'store'])->name('purchases.store');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'delete'])->name('purchases.delete');
		Route::get('/pendingList', [App\Http\Controllers\Admin\PurchaseController::class, 'pendingList'])->name('purchases.pendingList');
		Route::get('/approved/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'approved'])->name('purchases.approved');
		Route::get('/daily_report', [App\Http\Controllers\Admin\PurchaseController::class, 'dailyReport'])->name('purchases.daily_report');
		Route::get('/daily_report/pdf', [App\Http\Controllers\Admin\PurchaseController::class, 'dailyReportPdf'])->name('purchases.daily_report.pdf');
	});


	// default controlelr route 
	Route::get('/get_category', [App\Http\Controllers\Admin\DefaultController::class, 'getCategory'])->name('get_category');
	Route::get('/get_product', [App\Http\Controllers\Admin\DefaultController::class, 'getProduct'])->name('get_product');
	Route::get('/get_stock_check', [App\Http\Controllers\Admin\DefaultController::class, 'get_stock_check'])->name('get_stock_check');


	// invoices routes 
	Route::group(['prefix' => 'invoices'], function(){
		Route::get('/view', [App\Http\Controllers\Admin\InvoiceController::class, 'view'])->name('invoices.view');
		Route::get('/add', [App\Http\Controllers\Admin\InvoiceController::class, 'add'])->name('invoices.add');
		Route::post('/store', [App\Http\Controllers\Admin\InvoiceController::class, 'store'])->name('invoices.store');
		Route::get('/delete/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'delete'])->name('invoices.delete');
		Route::get('/pendingList', [App\Http\Controllers\Admin\InvoiceController::class, 'pendingList'])->name('invoices.pendingList');
		Route::get('/approved/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'approved'])->name('invoices.approved');
		Route::post('/approval/store/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'approvalStore'])->name('approval.store');
		Route::get('/invoices/printList', [App\Http\Controllers\Admin\InvoiceController::class, 'printList'])->name('invoices.printList');	
		Route::get('/invoices/print/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'invoicePrint'])->name('invoices.print');
		Route::get('/invoices/daily_report', [App\Http\Controllers\Admin\InvoiceController::class, 'invoiceDailyReport'])->name('invoices.daily_report');
		Route::get('/invoices/daily_report/pdf', [App\Http\Controllers\Admin\InvoiceController::class, 'invoiceDailyReportPdf'])->name('invoices.daily_report.pdf');
	});


	// stock routes
	Route::group(['prefix' => 'stock'], function(){
		Route::get('/report', [App\Http\Controllers\Admin\StockController::class, 'stockReport'])->name('stock.report');
		Route::get('/report/pdf', [App\Http\Controllers\Admin\StockController::class, 'stockReportPdf'])->name('stock.report.pdf');
		Route::get('/report/criteria', [App\Http\Controllers\Admin\StockController::class, 'stockReportCriteria'])->name('stock.criteria');
		Route::get('/report/criteria/supplier', [App\Http\Controllers\Admin\StockController::class, 'stockReportCriteriaSupplier'])->name('stock.criteria.supplier');
		Route::get('/report/criteria/category', [App\Http\Controllers\Admin\StockController::class, 'stockReportCriteriaCategory'])->name('stock.criteria.category');
	});

});
