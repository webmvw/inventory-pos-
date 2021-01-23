@extends('admin.layout.master')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Stock</li>
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
            <h3 class="card-title">Stock List</h3>
            <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print Stock</a>
          </div>

          <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>In.Qty</th>
                    <th>Out.Qty</th>
                    <th>Stock</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allProduct as $key=>$value)
                    @php 
                      $buying_total = App\Models\Purchase::where('category_id', $value->category_id)->where('product_id', $value->id)->where('status', '1')->sum('quantity');
                      $selling_total = App\Models\InvoiceDetail::where('category_id', $value->category_id)->where('product_id', $value->id)->where('status', '1')->sum('selling_qty');
                    @endphp
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->supplier->name }}</td>
                        <td>{{ $value->category->name }}</td>
                        <td>{{ $value->unit->name }}</td>
                        <td>{{ $buying_total }}</td>
                        <td>{{ $selling_total }}</td>
                        <td>{{ $value->quantity }}</td>
                      </tr>
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>In.Qty</th>
                    <th>Out.Qty</th>
                    <th>Stock</th>
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