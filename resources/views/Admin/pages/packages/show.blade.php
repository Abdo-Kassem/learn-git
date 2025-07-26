@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-eye"></i> {{ trans('backend.show') }} {{ trans('backend.package') }} 
@endsection

<?php use App\Models\Package; ?>

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('packages.edit' , $package->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('packages.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">

                <div class="row">
                    @if($package->image)
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="imagePreview">
                                    <img style="width:100%;height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($package->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-{{ $package->image == null ? 12 : 8 }}">   
                        <!-- Main Info  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $package->name_ar : $package->name_fr }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.category') }}</b></label>
                                    <h4 style="margin:0">{{ app()->getLocale() == 'ar' ? $package->category->name_ar : $package->category->name_fr }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.days_number') }}</b></label>
                                    <h4 style="margin:0">{{ $package->days_number }}</h4>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.price') }}</b></label>
                                    <h4 style="margin:0">{{ $package->price }}</h4>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.description') }}</b></label>
                                    <h4 style="margin:0">
                                        <h4 style="margin:0">{!! nl2br(app()->getLocale() == 'ar' ? $package->description_ar : $package->description_en) !!}</h4>
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
                                        <p>{{ $package->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $package->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
			                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $package->updated_at->format('Y-m-d') }}</p>
                                        <p>{{ $package->updated_at->format('h:i A') }}</p>
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