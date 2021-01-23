<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\Customer;
use Auth;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use DB;
use PDF;



class InvoiceController extends Controller
{

    
     public function view(){
         $allInvoices = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
    	return view('admin.pages.invoice.view-invoice', compact('allInvoices'));
    }



    public function add(){
        $data['customers'] = Customer::get();
    	$data['categorys'] = Category::get();
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if($invoice_data == null){
            $firstReg = "0";
            $data['invoice_no'] = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data+1;
        }
        $data['date'] = date('Y-m-d');
    	return view('admin.pages.invoice.add-invoice', $data);
    }




    public function store(Request $request){
    	if ($request->category_id == null) {
            return redirect()->back()->with('error', 'Sorry! you do not select any item.');
        }else{
            if ($request->paid_amount > $request->estimated_amount) {
                return redirect()->back()->with('error', 'Paid Amount maximum than estimate amount.');
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id; 
                DB::transaction(function() use($request, $invoice){
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++) { 
                            $invoiceDetail = new InvoiceDetail();
                            $invoiceDetail->date = date('Y-m-d', strtotime($request->date));
                            $invoiceDetail->invoice_id = $invoice->id;
                            $invoiceDetail->category_id = $request->category_id[$i];
                            $invoiceDetail->product_id = $request->product_id[$i];
                            $invoiceDetail->selling_qty = $request->selling_qty[$i];
                            $invoiceDetail->unit_price = $request->unit_price[$i];
                            $invoiceDetail->selling_price = $request->selling_price[$i];
                            $invoiceDetail->status = '1';
                            $invoiceDetail->save(); 
                        }

                        if($request->customer_id == '0'){
                            $customer = new Customer;
                            $customer->name = $request->customer_name;
                            $customer->phone = $request->customer_phone;
                            $customer->address = $request->customer_address;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment;
                        $paymentDetail = new PaymentDetail;
                        $payment->invoice_id = $invoice->id;
                        $paymentDetail->invoice_id = $invoice->id;

                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->total_amount = $request->estimated_amount;
                        $payment->discount_amount = $request->discount_amount;

                        if($payment->paid_status == 'Full_Paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $paymentDetail->current_paid_amount = $request->estimated_amount;
                        }elseif ($payment->paid_status == 'Full_Due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $paymentDetail->current_paid_amount = '0';
                        }elseif ($payment->paid_status == 'Partical_Paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount-$request->paid_amount;
                            $paymentDetail->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();

                        $paymentDetail->date = date('Y-m-d', strtotime($request->date));
                        $paymentDetail->save();

                    }
                });
            }
        }
        return redirect()->route('invoices.pendingList')->with("success", "Invoice Added Successfully!!");
    }






    public function delete($id){
    	$invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();
        return redirect()->route('invoices.pendingList')->with('success', 'Invoice Deleted Successfully!!');
    }






    public function pendingList(){
        $allInvoices = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('admin.pages.invoice.view-pendinglist', compact('allInvoices'));
    }






    public function approved($id){
        $invoices = Invoice::with(['invoiceDetail'])->find($id);
        return view('admin.pages.invoice.invoice-view', compact('invoices'));
    }




    public function approvalStore(Request $request, $id){
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('error', 'Sorry! you approve maximum quantity');
            }       
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request, $invoice, $id){
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id', $key)->first();
                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->route('invoices.pendingList')->with('success', 'Invoice Approved Successfully.');   
    }




    public function printList(){
        $allInvoices = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('admin.pages.invoice.invoice-printlist', compact('allInvoices'));
    }

    public function invoicePrint($id){
        $data['invoices'] = Invoice::with(['invoiceDetail'])->find($id);
        $pdf = PDF::loadView('admin.pdf.invoice-pdf', $data);
        return $pdf->stream('invoice.pdf');
    }




    public function invoiceDailyReport(){
        return view('admin.pages.invoice.daily-invoice-report');
    }

    public function invoiceDailyReportPdf(Request $request){
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Invoice::whereBetween('date', [$sdate,$edate])->where('status', '1')->get();
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('admin.pdf.daily-report', $data);
        return $pdf->stream('invoice.pdf');
    }
}
