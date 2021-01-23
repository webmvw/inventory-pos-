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
            <h3 class="card-title">Invoice List</h3>
            <!-- <a href="{{ route('invoices.add') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add Invoice</a> -->
          </div>

          <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-sm table-bordered table-hover table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Action</th> 
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allInvoices as $key=>$invoice)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>
                        {{ $invoice->payment->customer->name }}
                        ({{ $invoice->payment->customer->phone }}-{{ $invoice->payment->customer->address }})
                      </td>
                      <td>{{ $invoice->invoice_no }}</td>
                      <td>{{ date('Y-m-d', strtotime($invoice->date)) }}</td>
                      <td>{{ $invoice->description }}</td>
                      <td>{{ $invoice->payment->total_amount }}</td>
                      <td>
                        <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank" title="Print" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Action</th>   
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->

          <div class="card-footer"></div>

        </div>
        


      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->

    @endsection