@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.package') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('packages.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('packages.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category_id"><b>{{ trans('backend.category') }}</b></label>
                            <select name="category_id" id="category_id" class="form-control select2" style="width:100%">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_fr }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" id="days_number">
                        <div class="form-group">
                            <label for="days_number"><b>{{ trans('backend.days_number') }}</b></label>
                            <input type="number" name="days_number" id="days_number" class="form-control {{ $errors->has('days_number') ? 'is-invalid' : '' }}" value="{{ old('days_number', 1) }}" min="1">
                            @if ($errors->has('days_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('days_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price"><b>{{ trans('backend.price') }}</b></label>
                            <input type="number" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price', 99) }}" min="99">
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>       
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_ar"><b>{{ trans('backend.description_ar') }}</b></label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="form-control">{{ old('description_ar') }}</textarea>
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
                            <textarea name="description_fr" id="description_fr" rows="4" class="form-control">{{ old('description_fr') }}</textarea>
                            @if ($errors->has('description_fr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_fr') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                            <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('image') ? 'is-invalid' : '' }}">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:250px;height:200px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="">
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
        name_ar : { required : true , minlength: 3 },
        name_fr : { required : true , minlength: 3 },
        category_id : { required : true },
        price : { required : true },
        days_number : { required : true },
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