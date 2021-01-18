<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Purchase;
use Auth;

class PurchaseController extends Controller
{
    public function view(){
    	$allPurchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
    	return view('admin.pages.purchase.view-purchase', compact('allPurchases'));
    }

    public function add(){
    	$data['suppliers'] = Supplier::get();
    	$data['categorys'] = Category::get();
    	$data['products'] = Product::get();
    	return view('admin.pages.purchase.add-purchase', $data);
    }

    public function store(Request $request){
    	if ($request->category_id == null) {
            return redirect()->back()->with('error', 'Sorry! you do not select any item.');
        }else{
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) { 
                $purchase = new Purchase();
                $purchase->supplier_id = $request->purchase_supplier_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->description = $request->description[$i];
                $purchase->quantity = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->status = "0";
                $purchase->created_by = Auth::user()->id;
                $purchase->save();  
            }
            return redirect()->route('purchases.view')->with("success", "Purchase updated Successfully!!");
        }
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
