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


<!-- toastr js -->
<script type="text/javascript" src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ asset('/admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/admin/dist/js/demo.js') }}"></script>

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
    <!-- Page specific script -->
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


@if(Session::has('reocrd_added'))
  <script type="text/javascript">
    toastr.success("{!!Session::get('reocrd_added')!!}");
    toastr.options.closeMethod = 'fadeOut';
    toastr.options.closeDuration = 4000;
    toastr.options.closeEasing = 'swing';
    toastr.options.closeButton = true;
  </script>
@endif

@if(Session::has('reocrd_updated'))
  <script type="text/javascript">
    toastr.success("{!!Session::get('reocrd_updated')!!}");
    toastr.options.closeMethod = 'fadeOut';
    toastr.options.closeDuration = 4000;
    toastr.options.closeEasing = 'swing';
    toastr.options.closeButton = true;
  </script>
@endif




</body>
</html>


