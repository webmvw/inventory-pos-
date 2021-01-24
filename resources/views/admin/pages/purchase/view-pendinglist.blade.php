@extends('admin.layout.master')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Purchase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Purchase</li>
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
            <h3 class="card-title">Pending Purchase List</h3>
          </div>

          <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-sm table-bordered table-hover table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying price</th>
                    <th>Status</th>                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allPurchases as $key=>$value)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->purchase_no }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                        <td>{{ $value->product->name }}</td>
                        <td>{{ $value->category->name }}</td>
                        <td>{{ $value->supplier->name }}</td>
                        <td>{{ $value->quantity }} {{ $value->product->unit->name }}</td>
                        <td>{{ $value->unit_price }}</td>
                        <td>{{ $value->buying_price }}</td>
                        <td>
                          @if($value->status == 0)
                          <span style="background: red;color:#fff;padding: 5px;font-size:14px;">Pending</span>
                          @else
                          <span style="background: green;color:#fff;padding: 5px;font-size:14px;">Approved</span>
                          @endif
                        </td>
                        <td>
                          @if($value->status == 0)
                          <a href="{{ route('purchases.approved', $value->id) }}" id="approveButton" title="Approve" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i></a>
                          <a href="{{ route('purchases.delete', $value->id) }}" id="deleteButton" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          @endif
                        </td>
                      </tr>
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying price</th>
                    <th>Status</th>                    
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