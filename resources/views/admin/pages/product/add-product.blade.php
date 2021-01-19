@extends('admin.layout.master')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
            <h3 class="card-title">Add Product</h3>
            <a href="{{ route('products.view') }}" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Product List</a>
          </div>

          <!-- /.card-header -->
             <form method="post" action="{{ route('products.store') }}" id="productForm" novalidate="novalidate"> 
              @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <select id="supplier" class="form-control select2" name="supplier">
                          <option value="">Please Select Supplier</option>
                          @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" class="form-control select2" name="category">
                          <option value="">Please Select Category</option>
                          @foreach($categorys as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label for="unit">Unit</label>
                        <select id="unit" class="form-control  select2" name="unit">
                          <option value="">Please Select Unit</option>
                          @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form> 

          <div class="card-footer"></div>

        </div>
        


      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->




    @endsection