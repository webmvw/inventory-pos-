  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- DataTables  & Plugins -->
<script src="{{ asset('/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<!-- jquery-validation -->
<script src="{{ asset('/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('/admin/plugins/select2/js/select2.full.min.js') }}"></script>


<!-- toastr js -->
<script type="text/javascript" src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>


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




<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>

<script>
$(function () {
  $('#quickForm').validate({
    rules: {
      name: {
        required: true,
        maxlength:60,
      },
      phone: {
        required: true,
        number: true,
        maxlength: 20,
      },
      email: {
        required: true,
        email: true,
      },
      address: {
        required: true,
        maxlength: 100,
      },
    },
    messages: {
      name: {
        required: "Please enter name",
        maxlength: "Your name must be at least 60 characters long"
      },
      phone: {
        required: "Please enter phone",
        number: "Only numeric characters allowed",
        maxlength: "Your phone must be at least 20 characters long"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      address: {
        required: "Please enter address",
        maxlength: "Your address must be at least 100 characters long"
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


<!-- product form validation -->
<script>
$(function () {
  $('#productForm').validate({
    rules: {
      name: {
        required: true,
        maxlength:60,
      },
      supplier: {
        required: true,
      },
      category: {
        required: true,
      },
      unit: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "Please enter name",
        maxlength: "Your name must be at least 60 characters long"
      },
      supplier: {
        required: "Please select supplier",
      },
      category: {
        required: "Please select category",
      },
      unit: {
        required: "Please select unit",
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






@if(Session::has('success'))
  <script type="text/javascript">
    toastr.success("{!!Session::get('success')!!}");
    toastr.options = {
      "closeMethod" : 'fadeOut',
      "closeDuration" : 4000,
      "closeEasing" : 'swing',
      "closeButton" : true,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
@endif 

@if(Session::has('error'))
  <script type="text/javascript">
    toastr.success("{!!Session::get('error')!!}");
    toastr.options = {
      "closeMethod" : 'fadeOut',
      "closeDuration" : 4000,
      "closeEasing" : 'swing',
      "closeButton" : true,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
@endif 

@if(Session::has('warning'))
  <script type="text/javascript">
    toastr.success("{!!Session::get('error')!!}");
    toastr.options = {
      "closeMethod" : 'fadeOut',
      "closeDuration" : 4000,
      "closeEasing" : 'swing',
      "closeButton" : true,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
@endif

@if(Session::has('info'))
  <script type="text/javascript">
    toastr.success("{!!Session::get('info')!!}");
    toastr.options = {
      "closeMethod" : 'fadeOut',
      "closeDuration" : 4000,
      "closeEasing" : 'swing',
      "closeButton" : true,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
@endif
  


</body>
</html>


