<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Auth;

class SupplierController extends Controller
{
    public function view(){
    	$allSupplier = Supplier::latest()->get();
    	return view('admin.pages.supplier.view-supplier', compact('allSupplier'));
    }

    public function add(){
    	return view('admin.pages.supplier.add-supplier');
    }

    public function store(Request $request){
    	$supplier = new Supplier;
    	$supplier->name = $request->name;
    	$supplier->phone = $request->phone;
    	$supplier->email = $request->email;
    	$supplier->address = $request->address;
    	$supplier->created_by = Auth::user()->id;
    	$supplier->save();
    	return redirect()->route('suppliers.view');
    }
}
