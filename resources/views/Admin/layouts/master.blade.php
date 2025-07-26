
<!DOCTYPE html>
<html>
<head>
<!-- FORM CSS CODE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <link rel='shortcut icon' href='images/favicon.ico' />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/bootstrap/css/bootstrap.min.css">
   <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/css/font-awesome-4.7.0/css/font-awesome.min.css">

  <!-- Color Picker  -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/color-picker.css">


  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/select2/select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/FixedHeader-3.1.4/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/FixedHeader-3.1.4/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Responsive-2.2.2/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Responsive-2.2.2/css/responsive.bootstrap.min.css">  
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Buttons-1.5.4/css/buttons.bootstrap.min.css">  


  <!-- include summernote css/js -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{ asset('css') }}/summernote.min.css"> 

  <!-- Full Calendar . -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" /> -->
  <link rel="stylesheet" href="{{ asset('css') }}/summernote.min.css"> 

  <!-- Arabic RTL  -->
  @if( app()->getLocale() == 'ar' )
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/AdminLTE.rtl.min.css">
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/rtl.css">
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/bootstrap/css/bootstrap.rtl.min.css">
  @endif
  


  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/skins/_all-skins.min.css">
 <!--Toastr notification -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/toastr/toastr.css">
  <!--Toastr notification end-->
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/iCheck/square/orange.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--Custom Css File-->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/custom.css">
  
  @if( app()->getLocale() == 'ar' )
    <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/custom-rtl.css">
  @endif

  <!-- Full Calendar . -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" /> -->


  <!-- Pace Loader -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/pace/pace.min.css">
    <!-- Theme color finder -->
  <script type="text/javascript">
    var sidebar_collapse = (typeof (Storage) !== "undefined") ? localStorage.getItem('collapse') : 'skin-blue';
  </script>
  <!-- jQuery 2.2.3 -->
  <!-- <script src="{{ asset('Dashboard') }}/plugins/jQuery/jquery-2.2.3.min.js"></script> -->
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <!-- </copy> -->  
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="{{ asset('css/mediaQuery.css') }}">

<style type="text/css">
   #chart_container {
   min-width: 320px;
   max-width: 600px;
   margin: 0 auto;
   }

   @font-face {
     font-family: 'Poppins';
     src: url('{{ asset("Dashboard") }}/css/fonts/Poppins/Poppins-Regular.ttf');
   }

   @font-face {
     font-family: 'Sukar';
     src: url('{{ asset("Dashboard") }}/css/fonts/Sukar/Sukar-Regular.otf');
   }

   @font-face {
     font-family: 'Cairo';
     src: url('{{ asset("Dashboard") }}/css/fonts/Cairo/Cairo-SemiBold.ttf');
   }

   @font-face {
     font-family: 'Almarai';
     src: url('{{ asset("Dashboard") }}/css/fonts/Almarai/Almarai-Regular.ttf');
   }

   *,body,div,p,span,label,h1,h2,h3,h4,h5,h6
   {
     font-family: 'Poppins';
     font-weight: 500;
   }
   
</style>

@if( app()->getLocale() == 'ar' )
   <style>
       *,body,div,p,span,label,h1,h2,h3,h4,h5,h6
        {
            font-family: 'Almarai';
            
        }
   </style>
@else
    <style>
       *,body,div,p,span,label,h1,h2,h3,h4,h5,h6
        {
            font-family: 'Poppins';
            font-weight: 500;
        }

        .sidebar-menu .treeview-menu>li.active a,
        .sidebar-menu .treeview-menu>li a:hover
        {
            font-weight: bold !important;
            transform: translateX(10px);
        }

        
   </style>
@endif

@yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  
  <!-- Change the theme color if it is set -->
   <script type="text/javascript">
    if(sidebar_collapse=='true'){
      $("body").addClass('sidebar-collapse');
    }
  </script> 
  <!-- end -->

  <!-- Start Main Header -->
  @include('Admin.includes._header')
 
  <!-- Left side column. contains the logo and sidebar -->
  @include('Admin.includes._sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="dashboard-page-title">
            @yield('pageTitle')
        </h1>
    </section>
    <!-- Content Header (Page header) -->
      
    <!-- Main content -->
    <section class="content">
      
        @yield('content')
    
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  
  @include('Admin.includes._footer')


</div>
<!-- ./wrapper -->




@include('Admin.layouts.footer-scripts')

<script>
    $(document).ready(function() {

        // Success Message ...
        @if( session()->has('success') )
            swal({
                title: "{!! session()->get("success") !!}",
                icon: "success",
                button : "{!! trans('backend.ok') !!}"
            });
        @endif

        // Error Message ...
        @if( session()->has('error') )
            swal({
                title: "{!! session()->get("error") !!}",
                icon: "error",
                button : "{!! trans('backend.ok') !!}"
            });
        @endif

        // Warning Message ...
        @if( session()->has('warning') )
            swal({
                title: "{!! session()->get("warning") !!}",
                icon: "warning",
                button : "{!! trans('backend.ok') !!}"
            });
        @endif

        // Confirm Delete .... ??!
        $(document).on('click' , '.delete' ,function(e){

            e.preventDefault();

            var that = $(this);

            swal({
                title: "{!! trans('backend.confirm_delete') !!}",
                icon: "error",
                buttons: ["{!! trans('backend.no') !!}", "{!! trans('backend.yes') !!}"],
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    that.closest('form').submit();
                }
            });

        });

       

        // Confirm Delete .... ??!
        $(document).on('click' , '.confirm_logout' ,function(e){

            e.preventDefault();

            var that = $(this);

            swal({
                title: "{!! trans('backend.confirm_logout') !!}",
                icon: "info",
                buttons: ["{!! trans('backend.no') !!}", "{!! trans('backend.yes') !!}"],
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    that.closest('form').submit();
                }
            });

        });

    } );
</script>


    @if (app()->getLocale() == 'fr')
        <script src="{{ asset('js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
    @else
        <script src="{{ asset('js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/validation/messages_ar.js') }}"></script>
    @endif

    @stack('scripts')
    <script src="{{ asset('Dashboard') }}/js/main.js"></script>
</body>
</html>
