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
                <input type="text" name="purchase_no"  class="form-control" id="purchase_no" >
              </div>
              <div class="col-md-4 form-group">
                <label for="purchase_supplier">Supplier</label>
                <select id="purchase_supplier" class="form-control select2" name="purchase_supplier">
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
                <select id="purchase_category" class="form-control select2" name="purchase_category">
                  <option value="">Select Category</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="purchase_product">Product</label>
                <select id="purchase_product" class="form-control select2" name="purchase_product">
                  <option value="">Select Product</option>
                </select>
              </div>
              <div class="col-md-4 form-group" style="padding-top:35px;">
                <a class="btn btn-primary btn-sm addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-body">
            <form action="{{ route('purchases.store') }}" method="post" id="myForm">
               @csrf
               <table class="table-sm table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th width="7%">Pcs/Kg</th>
                      <th width="10%">Unit Price</th>
                      <th>Description</th>
                      <th width="10%">Total Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="addRow" class="addRow">
                    
                  </tbody>
                  <tbody>
                    <tr>
                      <td colspan="5"></td>
                      <td>
                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background: #D8FDBA">
                      </td>
                      <td></td>
                    </tr>
                  </tbody> 
               </table>
               <br>
               <div class="form-group">
                 <button type="submit" class="btn btn-primary" id="storeButton">Purchase Store</button>
               </div>
            </form>
          </div> <!-- .card-body -->



          <div class="card-footer"></div>

        </div> <!-- .card end -->
        


      </div> <!-- .container-fluid end -->
    </section> <!-- .content end -->
    <!-- /.content -->



    <script type="text/javascript">
      $(function(){
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $(document).on('change', '#purchase_supplier', function(){
          var supplier_id = $(this).val();
          $.ajax({
            url:"{{ route('get_category') }}",
            type:"GET",
            data:{supplier_id:supplier_id},
            success:function(data){
              var html = '<option value="">Select Category</option>';
              $.each(data,function(key,v){
                html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
              });
              $('#purchase_category').html(html);
            }
          });  
        });
      });
    </script>


    <script type="text/javascript">
      $(function(){
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $(document).on('change', '#purchase_category', function(){
          var category_id = $(this).val();
          $.ajax({
            url:"{{ route('get_product') }}",
            type:"GET",
            data:{category_id:category_id},
            success:function(data){
              var html = '<option value="">Select Product</option>';
              $.each(data,function(key,v){
                html += '<option value="'+v.id+'">'+v.name+'</option>';
              });
              $('#purchase_product').html(html);
            }
          });  
        });
      });
    </script>


    <!-- extra html for if existing event -->
    <script type="text/x-handlebars-template" id="document-template">
      <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date[]" value="@{{date}}">
        <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
        <input type="hidden" name="purchase_supplier_id[]" value="@{{purchase_supplier_id}}">
        <td>
          <input type="hidden" name="category_id[]" value="@{{category_id}}">
          @{{category_name}}
        </td>
        <td>
          <input type="hidden" name="product_id[]" value="@{{product_id}}">
          @{{product_name}}
        </td>
        <td>
          <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
        </td>
        <td>
          <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="" required>
        </td>
        <td>
          <input type="text" class="form-control form-control-sm" name="description[]">
        </td>
        <td>
          <input type="number" class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
        </td>
        <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
      </tr>
    </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click', '.addeventmore', function(){
        var date = $('#date').val();
        var purchase_no = $('#purchase_no').val();
        var purchase_supplier_id = $('#purchase_supplier').val();
        var purchase_supplier_name = $('#purchase_supplier').find('option:selected').text();
        var purchase_category_id = $('#purchase_category').val();
        var purchase_category_name = $('#purchase_category').find('option:selected').text();
        var purchase_product_id = $('#purchase_product').val();
        var purchase_product_name = $('#purchase_product').find('option:selected').text();

        if(date == ''){
          toastr.error("Date is required");
          return false;
        }
        if(purchase_no == ''){
          toastr.error("Purchase No is required");
          return false;
        }
        if(purchase_supplier_id == ''){
          toastr.error("Supplier is required");
          return false;
        }
        if(purchase_category_id == ''){
          toastr.error("Category is required");
          return false;
        }
        if(purchase_product_id == ''){
          toastr.error("Product is required");
          return false;
        }

        var source = $('#document-template').html();
        var template = Handlebars.compile(source);
        var data ={
          date:date,
          purchase_no:purchase_no,
          purchase_supplier_id:purchase_supplier_id,
          category_id:purchase_category_id,
          category_name:purchase_category_name,
          product_id:purchase_product_id,
          product_name:purchase_product_name,
        }
        var html = template(data);
        $('#addRow').append(html);
      });

      $(document).on('click', '.removeeventmore', function(event){
        $(this).closest('.delete_add_more_item').remove();
        totalAmountPrice();
      });

      $(document).on('keyup click', '.unit_price, .buying_price', function(){
        var unit_price = $(this).closest('tr').find('input.unit_price').val();
        var qty =$(this).closest('tr').find('input.buying_qty').val();
        var total = unit_price*qty;
        $(this).closest('tr').find('input.buying_price').val(total);
        totalAmountPrice();
      });

      //calculate sum of amount in invoice
      function totalAmountPrice(){
        var sum = 0;
        $('.buying_price').each(function(){
          var value = $(this).val();
          if(!isNaN(value) && value.length != 0){
            sum += parseFloat(value);
          }
        });
        $('#estimated_amount').val(sum);
      }
    });
  </script>




    @endsection