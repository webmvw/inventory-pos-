<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use Auth;
use PDF;

class StockController extends Controller
{
    public function stockReport(){
    	$allProduct = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
    	return view('admin.pages.stock.stock-report', compact('allProduct'));
    }

    public function stockReportPdf(){
    	$data['allProduct'] = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        $pdf = PDF::loadView('admin.pdf.stock-report', $data);
        return $pdf->stream('invoice.pdf');
    }

    public function stockReportCriteria(){
    	$data['categorys'] = Category::all();
    	$data['suppliers'] = Supplier::all();
    	return view('admin.pages.stock.stock-report-criteria', $data);
    }

    public function stockReportCriteriaSupplier(Request $request){
    	$supplier_id = $request->supplier;
    	$data['supplier_name'] = Supplier::where('id', $supplier_id)->first()->name;
    	$data['products'] = Product::where('supplier_id', $supplier_id)->get();
    	$pdf = PDF::loadView('admin.pdf.stock-report-supplier-criteria', $data);
    	return $pdf->stream('invoice.pdf');
    }

    public function stockReportCriteriaCategory(Request $request){
    	$category_id = $request->category;
    	$data['category_name'] = Category::where('id', $category_id)->first()->name;
    	$data['products'] = Product::where('category_id', $category_id)->get();
    	$pdf = PDF::loadView('admin.pdf.stock-report-category-criteria', $data);
    	return $pdf->stream('invoice.pdf');
    }
}
