@extends('admin.layout.master')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Customers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Customers</li>
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
            <h3 class="card-title">Credit Customer List</h3>
            <a href="{{ route('customers.credit.pdf') }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Download PDF</a>
          </div>

          <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$value)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->customer->name }} ({{ $value->customer->phone }} - {{ $value->customer->address }})</td>
                        <td>{{ $value->invoice->invoice_no }}</td>
                        <td>{{ $value->invoice->date }}</td>
                        <td>{{ $value->due_amount }}</td>
                        <td>
                          <a href="{{ route('creditCustomer_invoiceEdit', $value->invoice_id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('creditCustomer_invoiceDetails', $value->invoice_id) }}" target="_blank"  title="Details" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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