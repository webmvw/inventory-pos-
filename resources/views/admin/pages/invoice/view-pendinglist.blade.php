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
            <h3 class="card-title">Pending Invoice List</h3>
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
                    <th>Status</th>
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
                          @if($invoice->status == 0)
                          <span style="background: red;color:#fff;padding: 5px;font-size:14px;">Pending</span>
                          @else
                          <span style="background: green;color:#fff;padding: 5px;font-size:14px;">Approved</span>
                          @endif
                        </td>
                        <td>
                          @if($invoice->status == 0)
                          <a href="{{ route('invoices.approved', $invoice->id) }}" title="Approve" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i></a>
                          <a href="{{ route('invoices.delete', $invoice->id) }}" id="deleteButton" title="Delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          @endif
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