<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Inventoy System | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

  <!-- toastr css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">

   <!-- sweetalert2 css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.css') }}"> 


  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">


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
  <script src="{{ asset('/admin/plugins/select2/js/select2.min.js') }}"></script>


  <!-- toastr js -->
  <script type="text/javascript" src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>

  <!-- toastr js -->
  <script type="text/javascript" src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>


  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>

  <!-- handlebar js -->
  <script src="{{ asset('admin/dist/js/handlebar.js') }}"></script>


</head>

