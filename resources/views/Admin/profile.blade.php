@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-user"></i> {{ trans('backend.profile') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border text-center">
            <h3 class="box-title" style="">{{ trans('backend.your_account_info') }} <i class="fa fa-key"></i></h3>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.profile.update') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="admin_id" value="{{ $admin->id }}">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label> -->
                            <div class="imagePreview">
                                <img style="width:100%;height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($admin->avatar) }}" alt="">
                            </div>
                            <input type="file" name="avatar" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Start Row  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name"><b>{{ trans('backend.first_name') }}</b></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ $admin->first_name }}">
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name"><b>{{ trans('backend.last_name') }}</b></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ $admin->last_name }}">
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><b>{{ trans('backend.email') }}</b></label>
                                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $admin->email }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone"><b>{{ trans('backend.phone') }}</b></label>
                                    <input type="number" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ $admin->phone }}">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password"><b>{{ trans('backend.password') }}</b></label>
                                    <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation"><b>{{ trans('backend.password_confirmation') }}</b></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                        </div>
                            
                    

                    <div class="col-md-12">
                        <div class="text-center" style="margin-top:10px">
                            <button type="submit" class="btn btn-success btn-block" style="font-size:16px"><i class="fa fa-refresh fa-fw fa-lg"></i> {{ trans('backend.update') }}</button>
                        </div>
                    </div>
                    
                
                <!-- End Row  -->

                        </div>
                    </div>
                </div>

                
            </form>
                    
        </div>    

    </div>

@endsection


@push('scrips')
<script>
$(document).ready(function(){

  // Validate Form ...
  $('#myForm').validate({
      rules : {
        first_name : { required : true , minlength: 3 },
        last_name : { required : true , minlength: 3 },
        email : { required : true , email: true },
        phone : { required : true , minlength: 10, maxlength:15 },
        password : {  minlength: 6 },
        password_confirmation : {  equalTo : '#password', minlength: 6 },
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