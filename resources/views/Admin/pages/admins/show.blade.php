@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.show') }} {{ trans('backend.admin') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            @if( $admin->status == 0 )
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-success" href="{{ route('admin.admins.activation' , $admin->id) }}">
                    <i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.activation') }}</a>
                </div>
            @else
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-danger" href="{{ route('admin.admins.activation' , $admin->id) }}">
                    <i class="fa fa-close fa-fw fa-lg"></i> {{ trans('backend.disable') }}</a>
                </div>
            @endif
            
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('admin.admins.edit' , $admin->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.admins.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- <label for="exampleInpu style="color:#337ab7"tFile"><b>{{ trans('backend.image') }}</b></label> -->
                            <div class="imagePreview">
                                <img style="width:100%;height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($admin->avatar) }}" alt="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        
                        <!-- Main Info  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">{{ $admin->first_name }} {{ $admin->last_name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.email') }}</b></label>
                                    <h4 style="margin:0">{{ $admin->email }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.phone') }}</b></label>
                                    <h4 style="margin:0">{{ $admin->phone }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.address') }}</b></label>
                                <h4 style="margin:0">{{ $admin->address ? $admin->address : '-----' }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.status') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $admin->status == 1 )
                                            <span class="badge label-success">{{ trans('backend.active') }}</span>
                                        @else
                                            <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Login Info  -->
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.login_count') }}</b></label>
                                        <h4 style="margin:0">{{ $admin->login_count }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.logout_count') }}</b></label>
                                        <h4 style="margin:0">{{ $admin->logout_count }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.last_login') }}</b></label>
                                        <h4 style="margin:0">{{ $admin->last_login_date }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.last_logout') }}</b></label>
                                        <h4 style="margin:0">{{ $admin->last_logout_date }}</h4>
                                    </div>
                                </div>
                            </div>
                        <div>
                        
                        <!-- Datetime info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_by') }}</b></label>
                                    <h4 style="margin:0">{{ $admin->created_by ? $admin->created_by : '-----' }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_by') }}</b></label>
                                    <h4 style="margin:0">{{ $admin->updated_by ? $admin->updated_by : '-----' }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $admin->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $admin->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
			                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $admin->updated_at->format('Y-m-d') }}</p>
                                        <p>{{ $admin->updated_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                
            </form>
                    
        </div>   

    </div>

@endsection


@push('scripts')
<script>
$(document).ready(function(){

  // Validate Form ...
  $('#myForm').validate({
      rules : {
        first_name : { required : true , minlength: 3 },
        last_name : { required : true , minlength: 3 },
        email : { required : true , email: true },
        phone : { required : true , minlength: 10, maxlength:15 },
        password : { required : true , minlength: 6 },
        password_confirmation : { required : true , equalTo : '#password', minlength: 6 },
      },
      messages : {

      },
      errorEelement : 'span',
      errorPlacement : function(error , element){
          element.closest('.form-group').append(error);
      },

  }); 

});
</script>
@endpush