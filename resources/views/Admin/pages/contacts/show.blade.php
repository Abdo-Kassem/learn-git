@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.show') }} {{ trans('backend.contact') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.pages.contacts.index') }}">
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
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>

                                    <h4 style="margin:0">{{ $contact->first_name }} {{ $contact->last_name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="email" style="color:#337ab7"><b>{{ trans('backend.email') }}</b></label>

                                    <h4 style="margin:0">{{ $contact->email }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="phone" style="color:#337ab7"><b>{{ trans('backend.phone') }}</b></label>

                                    <h4 style="margin:0">{{ $contact->phone }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="subject" style="color:#337ab7"><b>{{ trans('backend.subject') }}</b></label>

                                    <h4 style="margin:0">{{ $contact->subject }}</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="message" style="color:#337ab7"><b>{{ trans('backend.message') }}</b></label>

                                    <h4 style="margin:0">{{ $contact->message }}</h4>
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
                                        <p>{{ $contact->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $contact->created_at->format('h:i A') }}</p>
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
