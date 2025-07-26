@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-edit"></i> {{ trans('backend.edit') }} {{ trans('backend.brands') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.brands.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.brands.update' , $brand->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar"><b>{{ trans('backend.name_ar') }}</b></label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" value="{{ $brand->name_ar }}">
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
                            <input type="text" name="name_fr" id="name_fr" class="form-control {{ $errors->has('name_fr') ? 'is-invalid' : '' }}" value="{{ $brand->name_fr }}">
                            @if ($errors->has('name_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.logo') }}</b></label>
                            <input type="file" name="logo" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                            @if ($errors->has('logo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:100%;height:250px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($brand->logo) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center" style="margin-top:30px">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-refresh fa-fw fa-lg"></i> {{ trans('backend.update') }}</button>
                        </div>
                    </div>
                    
                </div>
                <!-- End Row  -->
                
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