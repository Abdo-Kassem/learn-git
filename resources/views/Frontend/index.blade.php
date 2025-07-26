@extends('Frontend.layouts.master')

@section('content')

    <!-- Banner -->
    @include('Frontend.includes._banner')


    <!-- Screenshots -->
    <section id="screenshots" class="bg-grey">
        
        <!-- Container -->
        <div class="container">
            
            <!-- Section title -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6">
                    
                    <div class="section-title text-center">
                        <h3>{{ trans('backend.screenshots') }}</h3>
                        <!--
                        <p>Morbi velit leo, sodales in purus eu, pretium accumsan nunc. Praesent eu diam ut ante consequat euismod.</p>
                        -->
                    </div>
                    
                </div>
            </div>
        
            <div class="row">
                
                <div class="col-12">
                    
                    <!-- Carousel -->
                    <div class="owl-carousel owl-theme screenshot-slider zoom-screenshot">
                        
                        <div class="item">
                            <a href="{{asset('Frontend/images/screenshots/1.png')}}">
                                <img src="{{asset('Frontend/images/screenshots/1.png')}}" alt="" />
                            </a>
                        </div>
                        
                        <div class="item">
                            <a href="{{asset('Frontend/images/screenshots/2.png')}}">
                                <img src="{{asset('Frontend/images/screenshots/2.png')}}" alt="" />
                            </a>
                        </div>
                        
                        <div class="item">
                            <a href="{{asset('Frontend/images/screenshots/3.png')}}">
                                <img src="{{asset('Frontend/images/screenshots/3.png')}}" alt="" />
                            </a>
                        </div>
                        
                        <div class="item">
                            <a href="{{asset('Frontend/images/screenshots/4.png')}}">
                                <img src="{{asset('Frontend/images/screenshots/4.png')}}" alt="" />
                            </a>
                        </div>
                        
                        <div class="item">
                            <a href="{{asset('Frontend/images/screenshots/5.png')}}">
                                <img src="{{asset('Frontend/images/screenshots/5.png')}}" alt="" />
                            </a>
                        </div>
                        
                        <div class="item">
                            <a href="{{asset('Frontend/images/screenshots/6.png')}}">
                                <img src="{{asset('Frontend/images/screenshots/6.png')}}" alt="" />
                            </a>
                        </div>
                        
                        
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>


@endsection