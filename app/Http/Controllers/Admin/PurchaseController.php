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
            return redirect()->route('purchases.view')->with("success", "Purchase added Successfully!!");
        }
    }


    public function delete($id){
    	$getPurchase = Purchase::find($id);
    	$getPurchase->delete();
    	return redirect()->route('purchases.view')->with("info", "Product deleted Successfully!!");
    }

    public function pendingList(){
        $allPurchases = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('admin.pages.purchase.view-pendinglist', compact('allPurchases'));
    }
}
