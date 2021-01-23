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
            <h3 class="card-title">Invoice No #{{ $invoices->invoice_no }} ({{ date('d-m-Y', strtotime($invoices->date)) }})</h3>
             <a href="{{ route('invoices.pendingList') }}" class="btn btn-success btn-sm"><i class="fa fa-list"></i> View Pending Invoice List</a>
          </div>

          <!-- /.card-header -->
              <div class="card-body">
                @php
                  $payment = App\Models\Payment::where('invoice_id', $invoices->id)->first();
                @endphp
                <table class="table">
                  <tr>
                    <td rowspan="2"><h3>Customer Info</h3></td>
                    <td><b>Name:</b> {{ $payment->customer->name }}</td>
                    <td><b>Mobile:</b> {{ $payment->customer->phone }}</td>
                    <td><b>Address:</b> {{ $payment->customer->address }} </td>
                  </tr>
                  <tr>
                    <td colspan="3"><b>Description:</b> {{ $invoices->description }}</td>
                  </tr>
                </table>
                <br>
                <form action="{{ route('approval.store', $invoices->id) }}" method="post">
                  @csrf
                  <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="2">
                    <thead>
                      <tr class="text-center">
                        <th>SL</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Current Stock</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $total_sum = '0';  @endphp
                      @foreach($invoices['invoiceDetail'] as $key=>$value)
                        <tr class="text-center">
                          <input type="hidden" name="category_id[]" value="{{ $value->category_id }}">
                          <input type="hidden" name="product_id[]" value="{{ $value->product_id }}">
                          <input type="hidden" name="selling_qty[{{$value->id}}]" value="{{ $value->selling_qty }}">
                          <td>{{ $key+1 }}</td>
                          <td>{{ $value->category->name }}</td>
                          <td>{{ $value->product->name }}</td>
                          <td align="right">{{ $value->product->quantity }}</td>
                          <td align="right">{{ $value->selling_qty }}</td>
                          <td align="right">{{ $value->unit_price }}</td>
                          <td align="right">{{ $value->selling_price }}</td>
                        </tr>
                        @php $total_sum += $value->selling_price; @endphp
                      @endforeach
                      <tr>
                        <td align="right" colspan="6"><b>Total:</b></td>
                        <td align="right"><b>{{ $total_sum }}<b></td>
                      </tr>
                      <tr>
                        <td align="right" colspan="6">Discount Amount: </td>
                        <td align="right">{{ $payment->discount_amount }}</td>
                      </tr>
                      <tr>
                        <td align="right" colspan="6">Paid Amount: </td>
                        <td align="right">{{ $payment->paid_amount }}</td>
                      </tr>
                      <tr>
                        <td align="right" colspan="6">Due Amount:</td>
                        <td align="right">{{ $payment->due_amount }}</td>
                      </tr>
                      <tr>
                        <td align="right" colspan="6"><b>Grand Total:</b></td>
                        <td align="right"><b>{{ $payment->total_amount }}</b></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <button type="submit" class="btn btn-success btn-sm">Invoice Approve</button>
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
            $(document).on('click', '#approveButton', function(e){
              e.preventDefault();
              var link = $(this).attr('href');
              Swal.fire({
                title: 'Are you sure?',
                text: "You went to approve this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href=link;
                  Swal.fire(
                    'Approved!',
                    'Your file has been Approved.',
                    'success'
                  )
                }
              })
            });
          });
        </script>



    @endsection