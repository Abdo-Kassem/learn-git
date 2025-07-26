@extends('Frontend.layouts.master')

@section('content')

    <!-- Banner -->
    @include('Frontend.includes._banner')


    <!-- Contact Us -->
    <section id="screenshots" class="bg-grey contact-page">
        
        <!-- Container -->
        <div class="container">
            
            <!-- Section title -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6">
                    
                    <div class="section-title text-center">
                        <h3 style="text-transform:capitalize">{{ trans('backend.contact_page_header') }}</h3>
                        <!--
                        <p>Morbi velit leo, sodales in purus eu, pretium accumsan nunc. Praesent eu diam ut ante consequat euismod.</p>
                        -->
                    </div>
                    
                </div>
            </div>
        
            <div class="row">
                
                <div class="col-md-12">
                    <h4><b>{{ trans('backend.email') }}:</b> <a href="mailto:{{ $contacts->email }}">{{ $contacts->email }}</a></h4>
                    <h4><b>{{ trans('backend.phone') }}:</b> <a href="tel:{{ $contacts->phone }}" class="phone">{{ $contacts->phone }}</a></h4>
                </div>
                
            </div>
            
        </div>
        
    </section>


@endsection