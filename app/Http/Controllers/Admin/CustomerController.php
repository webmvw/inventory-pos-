<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
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


    public function creditCustomerInvoiceEdit($invoice_id){
        $payments = Payment::where('invoice_id', $invoice_id)->first();
        $date = date('Y-m-d');
        return view('admin.pages.customer.edit-invoice', compact('payments', 'date'));
    }

    public function creditCustomerInvoiceUpdate(Request $request, $invoice_id){
        if($request->new_paid_amount < $request->paid_amount){
            return redirect()->back()->with('error', 'Sorry! you have paid maximum value');
        }else{
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment_detail = new PaymentDetail;
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'Full_Paid'){
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()->paid_amount+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment->paid_status = 'Full_Paid';
                $payment_detail->current_paid_amount = $request->new_paid_amount; 
            }elseif($request->paid_status == 'Partical_Paid'){
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()->paid_amount+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()->due_amount-$request->paid_amount;
                $payment->paid_status = 'Partical_Paid';
                $payment_detail->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_detail->invoice_id = $invoice_id;
            $payment_detail->date = date('Y-m-d', strtotime($request->date));
            $payment_detail->updated_by = Auth::user()->id;
            $payment_detail->save();
            return redirect()->route('customers.credit')->with('success', 'Invoice Successfully Updated.');
        }
    }
}
