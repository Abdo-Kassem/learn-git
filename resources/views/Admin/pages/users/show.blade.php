@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.show') }} {{ trans('backend.user') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            @if( $user->status == 0 )
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-success" href="{{ route('admin.users.activation' , $user->id) }}">
                    <i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.activation') }}</a>
                </div>
            @else
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-danger" href="{{ route('admin.users.activation' , $user->id) }}">
                    <i class="fa fa-close fa-fw fa-lg"></i> {{ trans('backend.disable') }}</a>
                </div>
            @endif

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('admin.users.edit' , $user->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.users.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
        <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- <label for="exampleInpu style="color:#337ab7"tFile"><b>{{ trans('backend.image') }}</b></label> -->
                            <div class="imagePreview">
                                <img style="width:100%;height:270px;margin-top:5px" class="image-preview img-thumbnail" src="{{ asset($user->avatar) }}" alt="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Start Row  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">{{ $user->first_name }} {{ $user->last_name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.email') }}</b></label>
                                    <h4 style="margin:0">{{ $user->email }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.status') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $user->status == 1 )
                                            <span class="badge label-success">{{ trans('backend.active') }}</span>
                                        @else
                                            <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.phone') }}</b></label>
                                    <h4 style="margin:0">{{ $user->phone }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @if($user->badge != null)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.badge') }}</b></label>
                                        <h4 style="margin:0">
                                            @if($user->badge == App\Models\User::FEATURED)
                                                {{ trans('backend.seller_featured') }}
                                            @elseif($user->badge == App\Models\User::ACTIVE)
                                                {{ trans('backend.seller_active') }}
                                            @else
                                                {{ trans('backend.seller_new') }}
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.city') }}</b></label>
                                    <h4 style="margin:0">{{ $user->city()->value(app()->getLocale() == 'ar' ? 'name_ar' : 'name_en') }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.area') }}</b></label>
                                    <h4 style="margin:0">{{ $user->area()->value(app()->getLocale() == 'ar' ? 'name_ar' : 'name_en') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.login_count') }}</b></label>
                                    <h4 style="margin:0">{{ $user->login_count }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.logout_count') }}</b></label>
                                    <h4 style="margin:0">{{ $user->logout_count }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.last_login') }}</b></label>
                                    <h4 style="margin:0">{{ $user->last_login_date }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.last_logout') }}</b></label>
                                    <h4 style="margin:0">{{ $user->last_logout_date }}</h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_by') }}</b></label>
                                    <h4 style="margin:0">{{ $user->created_by ? $user->created_by : '-----' }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_by') }}</b></label>
                                    <h4 style="margin:0">{{ $user->updated_by ? $user->updated_by : '-----' }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $user->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $user->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
			                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $user->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $user->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @isset($user->location)
                        <div class="col-md-12">
                            <div class="form-group">
                                <div style="width:100%;height:400px;border-radius:15px;" id="google-map" style="background-color:red"></div>
                            </div>
                        </div>
                    @endisset
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
        first_name : { required : true , minlength: 3 },
        last_name : { required : true , minlength: 3 },
        email : { required : true , email: true },
        phone : { required : true , minlength: 10, maxlength:15 },
        password : { required : true , minlength: 6 },
        password_confirmation : { required : true , equalTo : '#password', minlength: 6 },
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

<script async type="text/javascript" src='https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env("GOOGLE_MAP_API_KEY") }}'></script>

<script>
    @isset($user->location)
        $(document).ready(function() {
            initMap();  
        })
    
        function initMap(lat,lng,marker){
            var myLatLng = {
                lat : lat ? lat : {{ $user->location->lat }},
                lng : lng ? lng : {{ $user->location->long }},
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

            /*// Add Drag event .
            google.maps.event.addListener(marker,'drag' , function(event){
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();

                $('#lat').val(lat);
                $('#lng').val(lng);

            });*/
        }
    @endisset
     
</script>
@endpush