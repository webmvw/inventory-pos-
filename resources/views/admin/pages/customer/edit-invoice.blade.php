@extends('admin.layout.master')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Invoice No #{{ $payments->invoice->invoice_no }} ({{ date('d-m-Y', strtotime($payments->invoice->date)) }})</h3>
             <a href="{{ route('customers.credit') }}" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Credit Customer List</a>
          </div>

          <!-- /.card-header -->
              <div class="card-body">
                <table class="table">
                  <tr>
                    <td rowspan="2"><h3>Customer Info</h3></td>
                    <td><b>Name:</b> {{ $payments->customer->name }}</td>
                    <td><b>Mobile:</b> {{ $payments->customer->phone }}</td>
                    <td><b>Address:</b> {{ $payments->customer->address }} </td>
                  </tr>
                  <tr>
                    <td colspan="3"><b>Description:</b> {{ $payments->invoice->description }}</td>
                  </tr>
                </table>
                <br>
                <form action="{{ route('creditCustomer_invoiceUpdate', $payments->invoice_id) }}" method="post">
                  @csrf
                  <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="2">
                    <thead>
                      <tr class="text-center">
                        <th>SL</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $invoice_details = App\Models\InvoiceDetail::where('invoice_id', $payments->invoice_id)->get(); 
                        $total_sum = '0';  
                      @endphp
                      @foreach($invoice_details as $key=>$value)
                        <tr class="text-center">
                          <td>{{ $key+1 }}</td>
                          <td>{{ $value->category->name }}</td>
                          <td>{{ $value->product->name }}</td>
                          <td align="right">{{ $value->selling_qty }}</td>
                          <td align="right">{{ $value->unit_price }}</td>
                          <td align="right">{{ $value->selling_price }}</td>
                        </tr>
                        @php $total_sum += $value->selling_price; @endphp
                      @endforeach
                      <tr>
                        <td align="right" colspan="5"><b>Total:</b></td>
                        <td align="right"><b>{{ $total_sum }}<b></td>
                      </tr>
                      <tr>
                        <td align="right" colspan="5">Discount Amount: </td>
                        <td align="right">{{ $payments->discount_amount }}</td>
                      </tr>
                      <tr>
                        <td align="right" colspan="5">Paid Amount: </td>
                        <td align="right">{{ $payments->paid_amount }}</td>
                      </tr>
                      <tr>
                        <td align="right" colspan="5">Due Amount:</td>
                        <input type="hidden" name="new_paid_amount" value="{{ $payments->due_amount }}">
                        <td align="right">{{ $payments->due_amount }}</td>
                      </tr>
                      <tr>
                        <td align="right" colspan="5"><b>Grand Total:</b></td>
                        <td align="right"><b>{{ $payments->total_amount }}</b></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <div class="form-row">
                     <div class="form-group col-md-3">
                        <label>Paid Status</label>
                        <select name="paid_status" id="paid_status" class="form-control form-control-sm" required>
                          <option value="">Select Status</option>
                          <option value="Full_Paid">Full Paid</option>
                          <option value="Partical_Paid">Partical Paid</option>
                        </select>
                        <input type="number" name="paid_amount" class="form-control form-control-sm paid_amount" id="paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                     </div>
                     <div class="form-group col-md-3">
                       <label for="date">Date</label>
                        <input type="date" name="date" value="{{$date}}" class="form-control form-control-sm" id="date" required>
                     </div>
                     <div class="form-group col-md-3" style="padding-top:32px;">
                       <button type="submit" class="btn btn-primary btn-sm">Update Invoice</button>
                     </div>
                   </div>

                </form>
              </div>
              <!-- /.card-body -->

          <div class="card-footer"></div>

        </div>
        


      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->


     <script type="text/javascript">
      $(function(){
        $(document).on('change', '#paid_status', function(){
          var paid_status = $(this).val();
          if(paid_status == 'Partical_Paid'){
            $('.paid_amount').show();
          }else{
            $('.paid_amount').hide();
          }
        });
      });
    </script>



    @endsection