@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.show') }} {{ trans('backend.faq') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('admin.pages.faqs.edit' , $faq->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.pages.faqs.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="row">   

                    <div class="col-md-12">
                        
                        <!-- Main Info  -->
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="question" style="color:#337ab7"><b>{{ trans('backend.question') }}</b></label>

                                    <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $faq->question_ar : $faq->question_en }}</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="answer" style="color:#337ab7"><b>{{ trans('backend.answer') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( app()->getLocale() == 'ar' )
                                            {!! $faq->answer_ar !!}
                                        @else
                                            {!! $faq->answer_en !!}
                                        @endif
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


