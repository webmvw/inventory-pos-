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
    <products

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daily Purchase Report</h3>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <form method="get" action="{{ route('purchases.daily_report.pdf') }}" target="_blank" id="quickForm" novalidate="novalidate">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label for="date">Start Date</label>
                  <input type="date" name="start_date"  class="form-control" id="start_date" >
                </div>
                <div class="col-md-4 form-group">
                  <label for="date">End Date</label>
                  <input type="date" name="end_date"  class="form-control" id="end_date" >
                </div>
                <div class="col-md-4 form-group" style="padding-top:35px;">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->

          <div class="card-footer"></div>
        </div> <!-- .card end -->
        

      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->


<script>
$(function () {
  $('#quickForm').validate({
    rules: {
      start_date: {
        required: true,
      },
      end_date: {
        required: true,
      },
    },
    messages: {
      start_date: {
        required: "Please enter start date",
      },
      end_date: {
        required: "Please enter end date",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>



    @endsection