@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-eye"></i> {{ trans('backend.show') }} {{ trans('backend.product') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            @if( $product->status == 0 )
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-success" href="{{ route('admin.products.activation' , $product->id) }}">
                    <i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.activation') }}</a>
                </div>
            @else
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-danger" href="{{ route('admin.products.activation' , $product->id) }}">
                    <i class="fa fa-close fa-fw fa-lg"></i> {{ trans('backend.disable') }}</a>
                </div>
            @endif
            
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('admin.products.edit' , $product->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.products.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- <label for="exampleInpu style="color:#337ab7"tFile"><b>{{ trans('backend.image') }}</b></label> -->
                            <div class="imagePreview">
                                <img style="width:100%;height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($product->image) }}" alt="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        
                        <!-- Main Info  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">{{ $product->name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.subcategory') }}</b></label>
                                    <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $product->subcategory->name_ar : $product->subcategory->name_fr }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.price') }}</b></label>
                                    <h4 style="margin:0">{{ $product->price }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>SKU</b></label>
                                    <h4 style="margin:0">{{ $product->SKU }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.status') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $product->status == 1 )
                                            <span class="badge label-success">{{ trans('backend.active') }}</span>
                                        @else
                                            <span class="badge label-danger">{{ trans('backend.sold') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.type') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $product->type == App\Models\Product::NEW )
                                            <span class="badge label-success">{{ trans('backend.new') }}</span>
                                        @else
                                            <span class="badge label-danger">{{ trans('backend.old') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.delivery_type') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $product->delivery_type == App\Models\Product::DELIVERY_FROM_PLACE )
                                            <span class="badge label-success">{{ trans('backend.delivery_in_place') }}</span>
                                        @else
                                            <span class="badge label-secondary">{{ trans('backend.avilable_shipping') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.city') }}</b></label>
                                    <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $product->city->name_ar : $product->city->name_fr }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.area') }}</b></label>
                                    <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $product->area->name_ar : $product->area->name_fr }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.views_number') }}</b></label>
                                    <h4 style="margin:0">{{ $product->views()->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.likes') }}</b></label>
                                    <h4 style="margin:0">{{ $product->likes()->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.owner') }}</b></label>
                                    <h4 style="margin:0">{{ $product->owner->first_name }} {{ $product->owner->last_name }}</h4>
                                </div>
                            </div>
                            @if ($product->brand_id)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.brand') }}</b></label>
                                        <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $product->brand()->value('name_ar') : $product->brand()->value('name_fr') }}</h4>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.description') }}</b></label>
                                    <h4 style="margin:0">
                                        <h4 style="margin:0">{!! $product->description !!}</h4>
                                    </h4>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <!-- Datetime info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $product->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $product->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
			                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $product->updated_at->format('Y-m-d') }}</p>
                                        <p>{{ $product->updated_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div style="width:100%;height:400px;border-radius:15px;" id="google-map" style="background-color:red"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.image_gallery') }}</b></label>
                        <br>
                        @php
                            $product_images = App\Models\ProductImage::where('product_id',$product->id)->get();
                        @endphp

                        @foreach($product_images as $img)
                            <div class="col-md-4">
                                <div class="image">
                                    <img src="{{ asset($img->image) }}" class="img-thumbnail" style="width:100%;height:200px;object-fit:contain;margin:10px 0" alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> 
            </form>        
        </div>   
    </div>
@endsection


@push('scripts')

<script>
    /*{{--
    $(document).ready(function() {
        initMap();  
    })

    function initMap(lat,lng,marker){
        var myLatLng = {
            lat : lat ? lat : {{ $product->location->lat }},
            lng : lng ? lng : {{ $product->location->long }},
        };

        map = new google.maps.Map(document.getElementById('google-map'), {
            zoom : 8,
            center : myLatLng,
            streetViewControl: false,
        });

        // Create marker .
        var marker = new google.maps.Marker({
            position: myLatLng,
            map,
            title: "{!! trans('backend.show_product_location') !!}",
            draggable : true
        });
    }
   --}}*/
</script>
@endpush