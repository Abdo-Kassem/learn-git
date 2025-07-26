<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ trans('backend.reset_password') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/bootstrap/css/bootstrap.min.css">
   <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/css/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/css/ionicons-2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/select2/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/FixedHeader-3.1.4/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/FixedHeader-3.1.4/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Responsive-2.2.2/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Responsive-2.2.2/css/responsive.bootstrap.min.css">  
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/DataTables-1.10.18/extensions/Buttons-1.5.4/css/buttons.bootstrap.min.css">  
  <!-- end -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/dist/css/AdminLTE.min.css">


  <style>
      body
      {
          background-color: #ccc !important;
      }
      
  </style>
  
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
    <style>
        input.form-control{
            padding-right : 15px !important
        }

        .login-box-body, .register-box-body
        {
            border-radius:10px !important
        }
    </style>
  @endif

  <!-- Pace Loader -->
  <link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/pace/pace.min.css">
    <!-- Theme color finder -->
  <script type="text/javascript">
    var sidebar_collapse = (typeof (Storage) !== "undefined") ? localStorage.getItem('collapse') : 'skin-blue';
  </script>
  <!-- jQuery 2.2.3 -->
  <script src="{{ asset('Dashboard') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- </copy> -->  
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('Dashboard') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<style type="text/css">

.btn.btn-flat
{
    border-radius:25px
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
            font-family: 'Sukar';
            font-weight: 500;
        }
   </style>
@else
    <style>
       *,body,div,p,span,label,h1,h2,h3,h4,h5,h6
        {
            font-family: 'Poppins';
            font-weight: 500;
        }
   </style>
@endif
</head>

<body class="hold-transition login-page">


<div class="container" style="max-width:450px;border-radius:100px">

<span id="datatable"></span>
  
  <div class="login-logo" style="margin-top:40px">

    <a href="#" style="color:#367fa9;font-size:30px"> <i class="fa fa-refresh"></i> <b>{{ trans('backend.reset_password') }}</b></a><br>
      
    <!-- <a href="{{ route('admin.login') }}" class="btn btn-danger" style="color:#eee"> <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
        
        <div class="text-center">
            <img style="width:120px;border-radius:5px;" src="{{ asset('uploads/admins/default.png') }}" alt="">
        </div>
    </p>

    <form id="myLoginForm" action="{{ route('admin.reset_password_post',$check_token->token) }}" method="post">

        {{ csrf_field() }}

        @include('Admin.includes._messages')

      <div class="form-group has-feedback">
        <input style="margin-bottom:5px" type="email" name="email" value="{{ $check_token->email }}" class="form-control {{ $errors->has('email') ? 'is-invalid-login' : '' }}" placeholder="{{ trans('backend.email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input style="margin-bottom:5px" type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid-login' : '' }}" placeholder="{{ trans('backend.new_password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        
      </div>

      <div class="form-group has-feedback">
        <input style="margin-bottom:5px" type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid-login' : '' }}" placeholder="{{ trans('backend.password_confirmation') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        
      </div>
      
      <div class="row">
        
        <div class="col-xs-12">
          <div class="form-group">
            <a href="{{ route('admin.login') }}" style="font-size:16px"> <i class="fa fa-reply"></i> {{ trans('backend.back_to_login') }}</a>
          </div>
        </div>
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block btn-border"> <i class="fa fa-check fa-lg fa-fw"></i> {{ trans('backend.save') }} </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--
        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>
    -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<script src="{{ asset('Dashboard') }}/dist/js/jquery-3.2.1.min.js"></script>


<script src="{{ asset('Dashboard') }}/dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('Dashboard') }}/dist/js/demo.js"></script>
<!-- page script -->
<!--Toastr notification -->
@include('Admin.layouts.footer-scripts')
<script src="{{ asset('Dashboard') }}/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('Dashboard') }}/plugins/iCheck/icheck.min.js"></script>


    @if (app()->getLocale() == 'en')
        <script src="{{ asset('js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
    @else
        <script src="{{ asset('js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/validation/messages_ar.js') }}"></script>
    @endif


<script>
  
  @if( session()->has('errorLogin') )
      swal({
          title: "{{ session()->get("errorLogin") }}",
          icon: "error",
          button : "{{ trans('backend.ok') }}"
      });
  @endif

  


</script>


<script>
$(document).ready(function(){



  // Validate Form ...
  $('#myLoginForm').validate({
      rules : {
        email : { required : true , email : true },
        password : { required : true , minlength : 6 },
        password_confirmation : { required : true , equalTo: '#password', minlength : 6 },
      },
      messages : {

      },
      errorEelement : 'span',
      errorPlacement : function(error , element){
          element.closest('.form-group').append(error);  
      },
      hightlight : function(element, errorClass , validClass){
        $(element).addClass('is-invalid');
      },
      unhightlight : function(element, errorClass , validClass){
        $(element).removeClass('is-invalid');
      }

  });

  
  @if( session()->has('error') )
    toastr.error("{{ session()->get('error') }}");
  @endif

  


});
</script>


</body>
</html>
