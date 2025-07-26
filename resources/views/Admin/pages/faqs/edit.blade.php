@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-edit"></i> {{ trans('backend.edit') }} {{ trans('backend.faq') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.edit') }} {{ trans('backend.infos') }}</h3>
            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.pages.faqs.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.pages.faqs.update' , $faq->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- Start Row  -->
                <div class="row">    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question_ar"><b>{{ trans('backend.question_ar') }}</b></label>
                            <input type="text" name="question_ar" id="question_ar" class="form-control {{ $errors->has('question_ar') ? 'is-invalid' : '' }}" value="{{ $faq->question_ar }}">
                            @if ($errors->has('question_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('question_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question_en"><b>{{ trans('backend.question_en') }}</b></label>
                            <input type="text" name="question_en" id="question_en" class="form-control {{ $errors->has('question_en') ? 'is-invalid' : '' }}" value="{{ $faq->question_en }}">
                            @if ($errors->has('question_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('question_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="answer_ar"><b>{{ trans('backend.answer_ar') }}</b></label>
                            <textarea  name="answer_ar" id="answer_ar" rows="5" class="form-control {{ $errors->has('answer_ar') ? 'is-invalid' : '' }}">{{ $faq->answer_ar }}</textarea>
                            @if ($errors->has('answer_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('answer_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="answer_ar"><b>{{ trans('backend.answer_en') }}</b></label>
                            <textarea  name="answer_en" id="answer_en" rows="5" class="form-control {{ $errors->has('answer_en') ? 'is-invalid' : '' }}">{{ $faq->answer_en }}</textarea>
                            @if ($errors->has('answer_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('answer_en') }}</strong>
                                </span>
                            @endif
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

    $('#answer_ar').summernote({
        height : 100
    });
    $('#answer_en').summernote({
        height : 100
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