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
    <products

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Add Invoice</h3>
            <a href="{{ route('invoices.view') }}" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Invoice List</a>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-2 form-group">
                <label for="invoice_no">InvoiceNo</label>
                <input type="text" name="invoice_no" value="{{ $invoice_no }}" class="form-control" id="invoice_no" readonly style="background: #D8FDBA">
              </div>
              <div class="col-md-2 form-group">
                <label for="date">Date</label>
                <input type="date" name="date" value="{{$date}}" class="form-control" id="date" >
              </div>
              <div class="col-md-3 form-group">
                <label for="invoiceCategory">Category</label>
                <select id="invoiceCategory" class="form-control select2" name="invoiceCategory">
                  <option value="">Select Category</option>
                  @foreach($categorys as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 form-group">
                <label for="invoiceProduct">Product</label>
                <select id="invoiceProduct" class="form-control select2" name="invoiceProduct">
                  <option value="">Select Product</option>
                </select>
              </div>
              <div class="col-md-1 form-group">
                <label >Stock(Pics/Kg)</label>
                <input type="text" name="current_stock_qty"  class="form-control" id="current_stock_qty" readonly style="background: #D8FDBA">
              </div>
              <div class="col-md-1 form-group" style="padding-top:35px;">
                <a class="btn btn-primary btn-sm addeventmore"><i class="fa fa-plus-circle"></i> Add</a>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-body">
            <form action="{{ route('invoices.store') }}" method="post" id="myForm">
               @csrf
               <table class="table-sm table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th width="7%">Pcs/Kg</th>
                      <th width="10%">Unit Price</th>
                      <th width="17%">Total Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="addRow" class="addRow">
                    
                  </tbody>
                  <tbody>
                    <tr>
                      <td colspan="4" align="right">Discount: </td>
                      <td>
                        <input type="number" name="discount_amount" class="form-control form-control-sm text-right" id="discount_amount" placeholder="Enter Discount Amount">
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>
                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background: #D8FDBA">
                      </td>
                      <td></td>
                    </tr>
                  </tbody> 
               </table>
               <br>
               <div class="form-row">
                 <div class="form-group col-md-12">
                   <textarea class="form-control" name="description" id="description" placeholder="Write Description Here..."></textarea>
                 </div>
               </div>
               <br>
               <div class="form-row">
                 <div class="form-group col-md-3">
                    <label>Paid Status</label>
                    <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                      <option value="">Select Status</option>
                      <option value="Full_Paid">Full Paid</option>
                      <option value="Full_Due">Full Due</option>
                      <option value="Partical_Paid">Partical Paid</option>
                    </select>
                    <input type="number" name="paid_amount" class="form-control form-control-sm paid_amount" id="paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                 </div>
                 <div class="form-group col-md-9">
                   <label>Add Customer</label>
                   <select class="form-control form-control-sm select2" name="customer_id" id="customer_id">
                     <option value="">Select Customer</option>
                     @foreach($customers as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone }} - {{ $customer->address }})</option>
                     @endforeach
                     <option value="0">New Customer</option>
                   </select>
                 </div>
               </div>
               <br>
               <div class="form-row new_customer" style="display: none;">
                 <div class="form-group col-md-4">
                   <input type="text" name="customer_name" class="form-control form-control-sm" id="customer_name" placeholder="Write Customer Name">
                 </div>
                 <div class="form-group col-md-4">
                   <input type="number" name="customer_phone" id="customer_phone" class="form-control form-control-sm" placeholder="Write Customer Phone">
                 </div>
                 <div class="form-group col-md-4">
                   <input type="text" name="customer_address" id="customer_address" class="form-control form-control-sm" placeholder="Write Customer Address">
                 </div>
               </div>
               <br>
               <div class="form-group">
                 <button type="submit" class="btn btn-primary" id="storeButton">Invoice Store</button>
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
        $(document).on('change', '#paid_status', function(){
          var paid_status = $(this).val();
          if(paid_status == 'Partical_Paid'){
            $('.paid_amount').show();
          }else{
            $('.paid_amount').hide();
          }
        });
      });
    </script>

    <script type="text/javascript">
      $(function(){
        $(document).on('change', '#customer_id', function(){
          var customer_id = $(this).val();
          if(customer_id == '0'){
            $('.new_customer').show();
          }else{
            $('.new_customer').hide();
          }
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

        $(document).on('change', '#invoiceCategory', function(){
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
              $('#invoiceProduct').html(html);
            }
          });  
        });
      });
    </script>

    <script type="text/javascript">
      $(function(){
        $(document).on('change', '#invoiceProduct', function(){
          var product_id = $(this).val();
          $.ajax({
            url:"{{ route('get_stock_check') }}",
            method:"GET",
            data:{product_id:product_id},
            success:function(data){
              $('#current_stock_qty').val(data);
            }
          });
        });
      });
    </script>





    <!-- extra html for if existing event -->
    <script type="text/x-handlebars-template" id="document-template">
      <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
        <input type="hidden" name="date" value="@{{date}}">
        <td>
          <input type="hidden" name="category_id[]" id="category_id" value="@{{category_id}}">
          @{{category_name}}
        </td>
        <td>
          <input type="hidden" name="product_id[]" value="@{{product_id}}">
          @{{product_name}}
        </td>
        <td>
          <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
        </td>
        <td>
          <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="" required>
        </td>
        <td>
          <input type="number" class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
        </td>
        <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
      </tr>
    </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click', '.addeventmore', function(){
        var date = $('#date').val();
        var invoice_no = $('#invoice_no').val();
        var invoiceCategory_id = $('#invoiceCategory').val();
        var invoiceCategory_name = $('#invoiceCategory').find('option:selected').text();
        var invoiceProduct_id = $('#invoiceProduct').val();
        var invoiceProduct_name = $('#invoiceProduct').find('option:selected').text();

        if(date == ''){
          toastr.error("Date is required");
          return false;
        }
        if(invoice_no == ''){
          toastr.error("Invoice No is required");
          return false;
        }
        if(invoiceCategory_id == ''){
          toastr.error("Category is required");
          return false;
        }
        if(invoiceProduct_id == ''){
          toastr.error("Product is required");
          return false;
        }

        var source = $('#document-template').html();
        var template = Handlebars.compile(source);
        var data ={
          date:date,
          invoice_no:invoice_no,
          category_id:invoiceCategory_id,
          category_name:invoiceCategory_name,
          product_id:invoiceProduct_id,
          product_name:invoiceProduct_name,
        }
        var html = template(data);
        $('#addRow').append(html);
      });

      $(document).on('click', '.removeeventmore', function(event){
        $(this).closest('.delete_add_more_item').remove();
        totalAmountPrice();
      });

      $(document).on('keyup click', '.unit_price, .selling_price', function(){
        var unit_price = $(this).closest('tr').find('input.unit_price').val();
        var qty =$(this).closest('tr').find('input.selling_qty').val();
        var total = unit_price*qty;
        $(this).closest('tr').find('input.selling_price').val(total);
        $('#discount_amount').trigger('keyup');
      });

      $(document).on('keyup click', '#discount_amount', function(){
        totalAmountPrice();
      });

      //calculate sum of amount in invoice
      function totalAmountPrice(){
        var sum = 0;
        $('.selling_price').each(function(){
          var value = $(this).val();
          if(!isNaN(value) && value.length != 0){
            sum += parseFloat(value);
          }
        });
        var discount_amount = parseFloat($('#discount_amount').val());
        if (!isNaN(discount_amount) && discount_amount != 0) {
          sum -= parseFloat(discount_amount);
        }
        $('#estimated_amount').val(sum);
      }
    });
  </script> 




    @endsection