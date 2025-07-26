@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.slider') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('sliders.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('sliders.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- End Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title_ar"><b>{{ trans('backend.title_ar') }}</b></label>
                            <input type="text" name="title_ar" id="title_ar" class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" value="{{ old('title_ar') }}">
                            @if ($errors->has('title_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title_fr"><b>{{ trans('backend.title_fr') }}</b></label>
                            <input type="text" name="title_fr" id="title_fr" class="form-control {{ $errors->has('title_fr') ? 'is-invalid' : '' }}" value="{{ old('title_fr') }}">
                            @if ($errors->has('title_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slider_image"><b>{{ trans('backend.image') }}</b></label>
                            <input type="file" name="slider_image" id="slider_image" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('slider_image') ? 'is-invalid' : '' }}">
                            @if ($errors->has('slider_image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slider_image') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:100%;min-height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset('uploads/sliders/default.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-center" style="margin-top:30px">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.save') }}</button>
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
        slider_image : { required : true },
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

