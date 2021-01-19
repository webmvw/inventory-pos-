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


<!-- sweet alert2  -->
<script type="text/javascript">
      $(function(){
        $(document).on('click', '#deleteButton', function(e){
          e.preventDefault();
          var link = $(this).attr('href');
          Swal.fire({
            title: 'Are you sure?',
            text: "You went to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href=link;
              Swal.fire(
                'Deleted!',
                'Your file has been Deleted.',
                'success'
              )
            }
          })
        });
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
    toastr.error("{!!Session::get('error')!!}");
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
    toastr.warning("{!!Session::get('warning')!!}");
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
    toastr.info("{!!Session::get('info')!!}");
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


