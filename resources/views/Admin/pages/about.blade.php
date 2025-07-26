@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-info-circle" aria-hidden="true"></i> {{ trans('backend.about') }}
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border text-center">
            <h3 class="box-title" style="padding:15px">{{ trans('backend.about') }} </h3>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.pages.about.update', $about->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('put')

                <div class="row">
                    <div class="col-md-12" style="margin-bottom:20px">
                        <div class="form-group">
                            <label for="description_ar"><b>{{ trans('backend.description_ar') }}</b></label>
                            <textarea name="description_ar" id="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}">{{ $about->description_ar }}</textarea>
                            @if ($errors->has('description_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-bottom:20px">
                        <div class="form-group">
                            <label for="description_fr"><b>{{ trans('backend.description_fr') }}</b></label>
                            <textarea name="description_fr" id="description_fr" class="form-control {{ $errors->has('description_fr') ? 'is-invalid' : '' }}">{{ $about->description_fr }}</textarea>
                            @if ($errors->has('description_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center" style="">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.save') }}</button>
                        </div>
                    </div>
                </div>
            </form><br><br>    
        </div>    
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){

    $('#description_fr').summernote({
        height : 200
    });

    $('#description_ar').summernote({
        height : 200
    });

  // Validate Form ...
  $('#myForm').validate({
      rules : {
        description_fr : { required : true },
        description_ar : { required : true },
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