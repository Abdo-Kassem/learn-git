@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-edit"></i> {{ trans('backend.edit') }} {{ trans('backend.categories') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.categories.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.categories.update' , $category->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar"><b>{{ trans('backend.name_ar') }}</b></label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" value="{{ $category->name_ar }}">
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
                            <input type="text" name="name_fr" id="name_fr" class="form-control {{ $errors->has('name_fr') ? 'is-invalid' : '' }}" value="{{ $category->name_fr }}">
                            @if ($errors->has('name_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color"><b>{{ trans('backend.color') }}</b></label>
                            <input type="color" name="color" id="color" 
                                class="{{ $errors->has('color') ? 'is-invalid' : '' }}" 
                                value="{{ $category->color }}" 
                                style="direction: ltr;text-align: right;height: 48px;display: block;width: 200px;">
                            @if ($errors->has('color'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_ar"><b>{{ trans('backend.description_ar') }}</b></label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="form-control">{{ $category->description_ar }}</textarea>
                            @if ($errors->has('description_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_fr"><b>{{ trans('backend.description_fr') }}</b></label>
                            <textarea name="description_fr" id="description_fr" rows="4" class="form-control">{{ $category->description_fr }}</textarea>
                            @if ($errors->has('description_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                            <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('image') ? 'is-invalid' : '' }}">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:100%;height:250px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($category->image) }}" alt="">
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

    //Summernote .
    $('#description_ar').summernote({
        height : 200
    });
    $('#description_en').summernote({
        height : 200
    });

  // Validate Form ...
  $('#myForm').validate({
      rules : {
        name_ar : { required : true , minlength: 3 },
        name_en : { required : true , minlength: 3 },
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