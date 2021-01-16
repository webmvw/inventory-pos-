<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function view(){
    	$allSupplier = Supplier::latest()->get();
    	return view('admin.pages.supplier.view', compact('allSupplier'));
    }

    public function add(){
    	
    }
}
