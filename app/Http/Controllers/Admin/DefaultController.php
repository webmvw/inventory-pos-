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

class DefaultController extends Controller
{
    public function getCategory(Request $request){
    	$supplier_id = $request->supplier_id;
    	$allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
    	return response()->json($allCategory, 200);
    }

    public function getProduct(Request $request){
    	$category_id = $request->category_id;
    	$allProduct = Product::where('category_id', $category_id)->get();
    	return response()->json($allProduct, 200);
    }
}
