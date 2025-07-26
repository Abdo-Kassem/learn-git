@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.users') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.users.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.users.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name"><b>{{ trans('backend.first_name') }}</b></label>
                            <input type="text" name="first_name" id="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name') }}">
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name"><b>{{ trans('backend.last_name') }}</b></label>
                            <input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}">
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.email') }}</b></label>
                            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone"><b>{{ trans('backend.phone') }}</b></label>
                            <input type="number" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
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
                            <label for="password"><b>{{ trans('backend.password') }}</b></label>
                            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation"><b>{{ trans('backend.password_confirmation') }}</b></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                            <input type="file" name="avatar" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:200px;height:160px;margin-top:5px" class="image-preview img-thumbnail" src="{{ asset('uploads/users/default.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-center" style="margin-top:30px;margin-bottom:10px">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.save') }}</button>
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
            name : { required : true , minlength: 3 },
            email : { required : true , email: true },
            phone : { required : true , minlength: 10, maxlength:15 },
            city_id : { required : true},
            area_id : { required : true},
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