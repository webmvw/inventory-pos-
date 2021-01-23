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
            <h3 class="card-title">Stock Report Criteria</h3>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Criteria According to Supplier</h3>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('stock.criteria.supplier') }}" method="get" target="_blank">
                      <div class="form-group">
                        <select class="form-control form-control-sm select2" name="supplier" id="supplier" required>
                          <option value="">Select Supplier</option>
                          @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                         <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-print"></i> Print</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <form action="{{ route('stock.criteria.category') }}" method="get" target="_blank">
                    <div class="card-header">
                      <h3 class="card-title">Criteria According to Category</h3>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <select class="form-control form-control-sm select2" name="category" id="category" required>
                          <option value="">Select Category</option>
                          @foreach($categorys as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                         <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-print"></i> Print</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer"></div>

        </div>
        


      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->




    @endsection