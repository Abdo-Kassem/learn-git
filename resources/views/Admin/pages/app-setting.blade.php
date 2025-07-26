@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-cogs"></i> {{ trans('backend.settings') }}
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border text-center">
            <h3 class="box-title" style="padding:10px">{{ trans('backend.settings') }} </h3>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.pages.setting.update',$setting->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                @csrf
                @method('put')
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone"><b>{{ trans('backend.phone') }}</b></label>
                            <input type="tel" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone',$setting->phone) }}">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="whatsapp_number"><b>{{ trans('backend.whatsapp_number') }}</b></label>
                            <input type="tel" name="whatsapp_number" id="whatsapp_number" class="form-control {{ $errors->has('whatsapp_number') ? 'is-invalid' : '' }}" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}">
                            @if ($errors->has('whatsapp_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('whatsapp_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.email') }}</b></label>
                            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email',$setting->email) }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address"><b>{{ trans('backend.address') }}</b></label>
                            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address',$setting->address) }}">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook"><b>{{ trans('backend.facebook') }}</b></label>
                            <input type="url" name="facebook" id="facebook" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" value="{{ old('facebook',$setting->facebook) }}">
                            @if ($errors->has('facebook'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('facebook') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram"><b>{{ trans('backend.instagram') }}</b></label>
                            <input type="url" name="instagram" id="instagram" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" value="{{ old('instagram',$setting->instagram) }}">
                            @if ($errors->has('instagram'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('instagram') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
               
                <br><br>
                <div class="row">
                    <!--{{--
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo"><b>{{ trans('backend.logo') }}</b></label>
                            <input type="file" name="logo" id="logo" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                            @if ($errors->has('logo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:250px;height:200px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($setting->logo) }}" alt="">
                            </div>
                        </div>
                    </div>
                    --}}-->
                    <div class="col-md-3">
                        <div class="text-center" style="">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.save') }}</button>
                        </div>
                    </div>
                </div>
                <br><br>
                
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
        phone : { required : true , minlength: 7, maxlength:15 },
        whatsapp_number : { required : true , minlength: 7, maxlength:15 },
        email : { required : true , email: true },
        sub_category_color : { required : true },
        category_color : { required : true }
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