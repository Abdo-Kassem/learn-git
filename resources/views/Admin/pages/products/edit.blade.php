@extends('Admin.layouts.master')

@php
    use App\Models\Product;
@endphp

@section('pageTitle') 
    <i class="fa fa-edit"></i> {{ trans('backend.edit') }} {{ trans('backend.product') }} 
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
                
            <form id="myForm" action="{{ route('admin.products.update' , $product->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.name') }}</b></label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $product->name }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subcategory_id"><b>{{ trans('backend.subcategory') }}</b></label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $subcategory->name_ar : $subcategory->name_fr }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('subcategory_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id"><b>{{ trans('backend.owner') }}</b></label>
                            <select name="user_id" id="user_id" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $product->user_id == $user->id ? 'selected' : '' }}>{{ $user->first_name }} {{ $user->last_name }}</option>
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
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $brand->name_ar : $brand->name_fr }}</option>
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
                                <option value="{{ Product::OLD }}" {{ $product->type == Product::OLD ? 'selected' : '' }}>{{ trans('backend.old') }}</option>
                                <option value="{{ Product::NEW }}" {{ $product->type == Product::NEW ? 'selected' : '' }}>{{ trans('backend.new') }}</option>
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
                                <option value="{{ Product::DELIVERY_FROM_PLACE }}" {{ $product->delivery_type == Product::DELIVERY_FROM_PLACE ? 'selected' : '' }}>{{ trans('backend.delivery_in_place') }}</option>
                                <option value="{{ Product::SHIPPING }}" {{ $product->delivery_type == Product::SHIPPING ? 'selected' : '' }}>{{ trans('backend.avilable_shipping') }}</option>
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
                                    <option value="{{ $city->id }}" {{ $product->city_id == $city->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $city->name_ar : $city->name_fr }}</option>
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
                                <option value="">..........</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ $product->area_id == $area->id ? 'selected' : '' }}>{{ app()->getLocale() == 'ar' ? $area->name_ar : $area->name_fr }}</option>
                                @endforeach
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
                            <input type="text" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ $product->price }}">
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
                            <textarea name="description" id="description" rows="4" class="form-control">{{ $product->description }}</textarea>
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
                                <img style="width:100%;height:250px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($product->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label><b>{{ trans('backend.image_gallery') }}</b></label>
                            <input type="file" name="multiple_images[]" style="padding: 10px;height:45px" class="form-control multiImages" id="multiImg" multiple>
                            <div class="" id="multi_img_preview"></div>
                            <div class="">
                                @php
                                    $product_images = App\Models\ProductImage::where('product_id',$product->id)->get();
                                @endphp
                                
                                <hr>
                                    <a href="" class="btn btn-primary add-single-image"><i class="fa fa-plus-circle fa-lg fa-fw"></i> {{ trans('backend.add_image_to_gallery') }}</a>
                                
                                <div class="row">
                                    @foreach($product_images as $img)
                                        <div class="col-md-4 col-{{ $img->id }}" style="margin:20px 0">
                                            <img style="width:100%;height:200px;object-fit:contain" class="img-thumbnail" src="{{ asset($img->image) }}" alt="">
                                            <div class="buttons text-center" style="display:flex;justify-content:center;margin:5px">
                                                <button class="btn btn-info edit-single-image" data-id="{{ $img->id }}"><i class="fa fa-pencil"></i> {{ trans('backend.edit') }}</button>
                                                &nbsp;&nbsp;
                                                <button class="btn btn-danger delete-single-image" data-id="{{ $img->id }}"><i class="fa fa-trash"></i> {{ trans('backend.delete') }}</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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

    <!-- Edit Image Modal  -->
    <div class="modal fade edit-single-image-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('backend.edit_image') }}</h4>
                </div>
                <div class="modal-body">
                <form id="editImageForm" action="{{ route('admin.products.update-single-image') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <input type="hidden" name="imageId" class="imageId" id="imageId">
                    
                        
                            <div class="form-group">
                                <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                                <div class="imagePreview">
                                    <img style="width:100%;margin-top:5px" class="image-preview2 img-thumbnail" src="{{ asset('uploads/products/default.png') }}" alt="">
                                </div>
                                <br>
                                <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image2 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('backend.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('backend.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Single Image Modal  -->
    <div class="modal fade add-single-image-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('backend.add_image') }}</h4>
                </div>
                <div class="modal-body">
                <form id="addImageForm" action="{{ route('admin.products.store-single-image') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                            <input type="hidden" name="product_id" class="product_id" id="product_id" value="{{ $product->id }}">
                    
                        
                            <div class="form-group">
                                <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                                <div class="imagePreview">
                                    <img style="width:100%;margin-top:5px" class="image-preview2 img-thumbnail" src="{{ asset('uploads/products/default.png') }}" alt="">
                                </div>
                                <br>
                                <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image2 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('backend.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('backend.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
$(document).ready(function(){

    $('#description').summernote({
        height : 150
    });

  
    $('#myForm').validate({
       rules : {
            name : { required : true},
            price : { required : true },
            category_id : { required : true},
            description : { required : true},
            type : { required : true},
            delivery_type : { required : true},
            city_id : { required : true},
            area_id : { required : true},
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


    // Delete Single Image .
    $(document).on('click' , '.delete-single-image' , function(e){
        e.preventDefault();

        var image_id = $(this).data('id');

        if( confirm("{{ trans('backend.confirm_delete') }}") ){
            $.ajax({
                url : "{{ route('admin.products.delete-single-image') }}",
                type : 'GET',
                data : { image_id : image_id },
                success : function(data){
                    $('.col-'+image_id).remove();
                }
            })
        }

    });

    // Edit Single Image .
    $(document).on('click' , '.edit-single-image' , function(e){
        e.preventDefault();

        var image_id = $(this).data('id');

        $('.edit-single-image-modal').modal('show');
        $('.imageId').val(image_id);

        if( image_id ){
            $.ajax({
            url : "{{ route('admin.products.edit-single-image') }}",
            type : 'GET',
            data : { image_id : image_id },
                success : function(data){
                    $('.image-preview2').attr('src' , data);
                }
            })
        }

    });

    // Update Single Image .
    $(document).on('submit' , '#editImageForm' , function(e){
        e.preventDefault();

            var url = $(this).attr('action');
            var image_id = $('#imageId').val();

            $.ajax({
                url : url,
                type : 'POST',
                contentType: false,
                processData: false,
                data : new FormData(this),
                success : function(data){
                    location.reload();
                }
            })

    });

    // Add Single Image .
    $(document).on('click' , '.add-single-image' , function(e){
        e.preventDefault();

        $('.add-single-image-modal').modal('show');

    });

    // Update Single Image .
    $(document).on('submit' , '#addImageForm' , function(e){
        e.preventDefault();

            var url = $(this).attr('action');

            $.ajax({
                url : url,
                type : 'POST',
                contentType: false,
                processData: false,
                data : new FormData(this),
                success : function(data){
                    console.log(data);
                    location.reload();
                }
            })

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

     // Load The Map .
     /*
     function initMap(lat,lng,marker){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const myLatLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                $('#lat').val(position.coords.latitude);
                $('#lng').val(position.coords.longitude);

                map = new google.maps.Map(document.getElementById('google-map'), {
                    zoom : 8,
                    center : myLatLng,
                    streetViewControl: true,
                });

                // Create marker .
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: "{{ trans('backend.choose_branch_location') }}",
                    draggable : true
                });

                // Add Drag event .
                google.maps.event.addListener(marker,'drag' , function(event){
                    var lat = event.latLng.lat();
                    var lng = event.latLng.lng();

                    $('#lat').val(lat);
                    $('#lng').val(lng);

                });

            });
        }
    }
    initMap();   
    */
});
</script>
@endpush