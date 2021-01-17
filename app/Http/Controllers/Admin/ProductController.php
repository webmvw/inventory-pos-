<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use Auth;

class ProductController extends Controller
{
    public function view(){
    	$allProduct = Product::latest()->get();
    	return view('admin.pages.product.view-product', compact('allProduct'));
    }

    public function add(){
    	$data['suppliers'] = Supplier::get();
    	$data['categorys'] = Category::get();
    	$data['units'] = Unit::get();
    	return view('admin.pages.product.add-product', $data);
    }

    public function store(Request $request){
    	$product = new Product;
    	$product->name = $request->name;
    	$product->supplier_id = $request->supplier;
    	$product->category_id = $request->category;
    	$product->unit_id = $request->unit;
    	$product->quantity = "0";
    	$product->created_by = Auth::user()->id;
    	$product->save();
    	return redirect()->route('products.view')->with("success", "Product Added Successfully!!");
    }


    public function edit($id){
    	$data['getProduct'] = Product::find($id);
    	$data['suppliers'] = Supplier::get();
    	$data['categorys'] = Category::get();
    	$data['units'] = Unit::get();
    	return view('admin.pages.product.edit-product', $data);
    }

    public function update(Request $request, $id){
    	$getProduct = Product::find($id);
    	$getProduct->name = $request->name;
    	$getProduct->supplier_id = $request->supplier;
    	$getProduct->category_id = $request->category;
    	$getProduct->unit_id = $request->unit;
    	$getProduct->quantity = "0";
    	$getProduct->updated_by = Auth::user()->id;
    	$getProduct->save();
    	return redirect()->route('products.view')->with("info", "Product updated Successfully!!");
    }

    public function delete($id){
    	$getProduct = Product::find($id);
    	$getProduct->delete();
    	return redirect()->route('products.view')->with("info", "Product deleted Successfully!!");
    }
}
