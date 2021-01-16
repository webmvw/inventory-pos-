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
    	return redirect()->route('suppliers.view')->with("success", "Supplier Added Successfully!!");
    }


    public function edit($id){
    	$getSupplier = Supplier::find($id);
    	return view('admin.pages.supplier.edit-supplier', compact('getSupplier'));
    }

    public function update(Request $request, $id){
    	$getSupplier = Supplier::find($id);
    	$getSupplier->name = $request->name;
    	$getSupplier->phone = $request->phone;
    	$getSupplier->email = $request->email;
    	$getSupplier->address = $request->address;
    	$getSupplier->updated_by = Auth::user()->id;
    	$getSupplier->save();
    	return redirect()->route('suppliers.view')->with("info", "Supplier updated Successfully!!");
    }

    public function delete($id){
    	$getSupplier = Supplier::find($id);
    	$getSupplier->delete();
    	return redirect()->route('suppliers.view')->with("info", "Supplier deleted Successfully!!");
    }
}
