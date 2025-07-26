@extends('Admin.layouts.master')

@php $lang = app()->getLocale() @endphp

@section('pageTitle') 
    <i class="fa fa-eye"></i> {{ trans('backend.show') }} {{ trans('backend.rating') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.ratings.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.user') }}</b></label>
                            <h4 style="margin:0">{{ $rating->user->first_name }} {{ $rating->user->last_name }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.seller') }}</b></label>
                            <h4 style="margin:0">{{ $rating->seller->first_name }} {{ $rating->seller->last_name }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.rating') }}</b></label>
                            <h4 style="margin:0">
                                @for($counter = 0; $counter < $rating->rating_number; $counter++ )
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                @endfor
                                @for($counter; $counter < 5; $counter++ )
                                    <i class="fa fa-star text-gray" aria-hidden="true"></i>
                                @endfor     
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.feedback') }}</b></label>
                            <h4 style="margin:0">{{ $rating->feedback }}</h4>
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
                                <p>{{ $rating->created_at->format('Y-m-d') }}</p>
                                <p>{{ $rating->created_at->format('h:i A') }}</p>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_at') }}</b></label>
                            <h4 style="margin:0">
                                <p>{{ $rating->updated_at->format('Y-m-d') }}</p>
                                <p>{{ $rating->updated_at->format('h:i A') }}</p>
                            </h4>
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
@endpush