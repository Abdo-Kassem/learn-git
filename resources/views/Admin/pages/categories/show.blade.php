@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-eye"></i> {{ trans('backend.show') }} {{ trans('backend.category') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('admin.categories.edit' , $category->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.categories.index') }}">
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
                                <img style="width:100%;height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($category->image) }}" alt="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        
                        <!-- Main Info  -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">{{ app()->getLocale()=='ar' ? $category->name_ar : $category->name_fr }}</h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.color') }}</b></label>
                                    <h4 style="margin:0"><span style="padding:5px 30px; background-color:{{ $category->color }}"></span></h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.description') }}</b></label>
                                    <h4 style="margin:0">{!! app()->getLocale()=='ar' ? $category->description_ar : $category->description_fr !!}</h4>
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
                                        <p>{{ $category->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $category->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
			                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $category->updated_at->format('Y-m-d') }}</p>
                                        <p>{{ $category->updated_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
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