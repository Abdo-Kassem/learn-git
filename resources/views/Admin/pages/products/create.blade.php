@extends('Admin.layouts.master')

@php
    use App\Models\Product;
@endphp

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.products') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.products.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.products.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.name') }}</b></label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subcategory_id"><b>{{ trans('backend.subcategory') }}</b></label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $subcategory->name_ar : $subcategory->name_fr }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('subcategory_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id"><b>{{ trans('backend.owner') }}</b></label>
                            <select name="user_id" id="user_id" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand_id"><b>{{ trans('backend.brands') }} ( {{ trans('backend.Optional') }} )</b></label>
                            <select name="brand_id" id="brand_id" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $brand->name_ar : $brand->name_fr }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('brand_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('brand_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type"><b>{{ trans('backend.type') }}</b></label>
                            <select name="type" id="type" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                <option value="{{ Product::OLD }}" {{ old('type') == Product::OLD ? 'selected' : '' }}>{{ trans('backend.old') }}</option>
                                <option value="{{ Product::NEW }}" {{ old('type') == Product::NEW ? 'selected' : '' }}>{{ trans('backend.new') }}</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="delivery_type"><b>{{ trans('backend.delivery_type') }}</b></label>
                            <select name="delivery_type" id="delivery_type" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                <option value="{{ Product::DELIVERY_FROM_PLACE }}" {{ old('delivery_type') == Product::DELIVERY_FROM_PLACE ? 'selected' : '' }}>{{ trans('backend.delivery_in_place') }}</option>
                                <option value="{{ Product::SHIPPING }}" {{ old('delivery_type') == Product::SHIPPING ? 'selected' : '' }}>{{ trans('backend.avilable_shipping') }}</option>
                            </select>
                            @if ($errors->has('delivery_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('delivery_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city_id"><b>{{ trans('backend.city') }}</b></label>
                            <select name="city_id" id="city_id" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $city->name_ar : $city->name_fr }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('city_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="area_id"><b>{{ trans('backend.area') }}</b></label>
                            <select name="area_id" id="area_id" class="form-control select2" style="width:100%">
                                
                            </select>
                            @if ($errors->has('area_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('area_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price"><b>{{ trans('backend.price') }}</b></label>
                            <input type="text" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price') }}">
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
                            <label for="description"><b>{{ trans('backend.description') }}</b></label>
                            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                            <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('image') ? 'is-invalid' : '' }}">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:100%;height:250px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset('uploads/products/default.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group">
                            <label><b>{{ trans('backend.image_gallery') }}</b></label>
                            <input type="file" name="multiple_images[]" style="padding: 10px;height:45px" class="form-control multiImages" id="multiImg" multiple>
                            <div class="" id="multi_img_preview"></div>
                        </div>
                    </div>

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

    $('#description').summernote({
        height : 150
    });

    // Validate Form ...
    $('#myForm').validate({
       rules : {
            name : { required : true},
            price : { required : true },
            subcategory_id : { required : true},
            user_id : { required : true},
            description : { required : true},
            type : { required : true},
            delivery_type : { required : true},
            city_id : { required : true},
            area_id : { required : true},
            image : { required : true }
        },
        messages : {
           },
           errorEelement : 'span',
           errorPlacement : function(error , element){
               element.closest('.form-group').append(error);
           },

    });

    $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/ style="margin:10px;object-fit:contain">').addClass('img-thumbnail').attr('src', e.target.result) .width(230)
                  .height(200); //create image element 
                      $('#multi_img_preview').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

          $('#multi_img_preview').html("");
          
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });

    $('#city_id').on('change', function() {
        cityId = $(this).val();

        if (cityId) {
            $.ajax({
                url: "{{ route('admin.products.get-areas.by-city_id')}}" ,
                method: 'GET',
                data: {cityId: cityId},
                success: function(data) {
                    options = "<option value=''>..........</option>";
                    data.data.forEach(function(area) {
                        let selected = "{{  old('area_id') }}" == area.id ? 'selected' : '';
                        let name = "{{ app()->getLocale() }}" == 'ar' ? area.name_ar : area.name_fr;
                        options += `<option value="${area.id}" ${selected}>${name}</option>`;
                    });

                    $('#area_id').html(options);
                }
            });
        }
    })
});

</script>
@endpush