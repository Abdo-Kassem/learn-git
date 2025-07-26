@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.city') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('cities.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('cities.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar"><b>{{ trans('backend.name_ar') }}</b></label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" value="{{ old('name_ar') }}">
                            @if ($errors->has('name_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_fr"><b>{{ trans('backend.name_fr') }}</b></label>
                            <input type="text" name="name_fr" id="name_fr" class="form-control {{ $errors->has('name_fr') ? 'is-invalid' : '' }}" value="{{ old('name_fr') }}">
                            @if ($errors->has('name_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
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
        name_ar : { required : true , minlength: 2 },
        name_fr : { required : true , minlength: 2 },
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