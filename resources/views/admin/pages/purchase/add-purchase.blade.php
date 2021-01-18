@extends('admin.layout.master')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Purchase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Purchase</li>
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
            <h3 class="card-title">Add Purchase</h3>
            <a href="{{ route('purchases.view') }}" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Purchase List</a>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="date">Date</label>
                <input type="date" name="date"  class="form-control" id="date" >
              </div>
              <div class="col-md-4 form-group">
                <label for="purches_no">Purches No</label>
                <input type="text" name="date"  class="form-control" id="purches_no" >
              </div>
              <div class="col-md-4 form-group">
                <label for="purchase_supplier">Supplier</label>
                <select id="purchase_supplier" class="form-control" name="supplier">
                  <option value="">Select Supplier</option>
                  @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 form-group">
                <label for="purchase_category">Category</label>
                <select id="purchase_category" class="form-control" name="category">
                  <option value="">Select Category</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="purchase_product">Product</label>
                <select id="purchase_product" class="form-control" name="product">
                  <option value="">Select Product</option>
                </select>
              </div>
              <div class="col-md-4 form-group" style="padding-top:35px;">
                <button type="" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Item</button>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>

          <div class="card-footer"></div>

        </div>
        


      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->





    @endsection