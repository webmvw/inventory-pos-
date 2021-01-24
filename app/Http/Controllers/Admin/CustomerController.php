<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use Auth;
use PDF;

class CustomerController extends Controller
{
    public function view(){
    	$allCustomers = Customer::latest()->get();
    	return view('admin.pages.customer.view-customer', compact('allCustomers'));
    }

    public function add(){
    	return view('admin.pages.customer.add-customer');
    }

    public function store(Request $request){
    	$customer = new Customer;
    	$customer->name = $request->name;
    	$customer->phone = $request->phone;
    	$customer->email = $request->email;
    	$customer->address = $request->address;
    	$customer->created_by = Auth::user()->id;
    	$customer->save();
    	return redirect()->route('customers.view')->with("success", "Customer Added Successfully!!");
    }


    public function edit($id){
    	$getCustomer = Customer::find($id);
    	return view('admin.pages.customer.edit-customer', compact('getCustomer'));
    }

    public function update(Request $request, $id){
    	$getCustomer = Customer::find($id);
    	$getCustomer->name = $request->name;
    	$getCustomer->phone = $request->phone;
    	$getCustomer->email = $request->email;
    	$getCustomer->address = $request->address;
    	$getCustomer->updated_by = Auth::user()->id;
    	$getCustomer->save();
    	return redirect()->route('customers.view')->with("info", "Customer updated Successfully!!");
    }

    public function delete($id){
    	$getCustomer = Customer::find($id);
    	$getCustomer->delete();
    	return redirect()->route('customers.view')->with("info", "Customer deleted Successfully!!");
    }


    public function creditCustomer(){
        $allData = Payment::whereIn('paid_status', ['Full_Due', 'Partical_Paid'])->get();
        return view('admin.pages.customer.credit-customer', compact('allData'));
    }

    public function creditCustomerPdf(){
        $data['allData'] = Payment::whereIn('paid_status', ['Full_Due', 'Partical_Paid'])->get();
        $pdf = PDF::loadView('admin.pdf.credit-customer', $data);
        return $pdf->stream('invoice.pdf');
    }
}
