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
                        <h3 style="text-transform:capitalize">{{ trans('backend.login_page_header') }}</h3>
                        <!--
                        <p>Morbi velit leo, sodales in purus eu, pretium accumsan nunc. Praesent eu diam ut ante consequat euismod.</p>
                        -->
                    </div>
                    
                </div>
            </div>
        
            <div class="row">
                
                <div class="col-md-6 offset-md-3">
                    
                    <form action="{{ route('frontend.my-account.check') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group mt-2 mb-3">
                                    <input type="email" name="email" class="form-control field-email" placeholder="{{ trans('backend.email') }}" required>
                                </div>
                            </div> 
                            <div class="col-12 col-lg-12">
                                <div class="form-group mt-2 mb-3">
                                    <input type="password" name="password" class="form-control field-name" placeholder="{{ trans('backend.password') }}" required>
                                </div>
                            </div>               
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-12 col-lg-12 mt-2">
                                <button type="submit" id="contact-submit" name="send" class="btn w-100">{{ trans('backend.login') }}</button>
                            </div>
                        </div>
                        
                    </form>
                    
                    <!-- Submit Results -->
                    <div class="contact-form-result">
                        <h4>Thank you for the e-mail!</h4>
                        <p>Your message has already arrived! We'll contact you shortly.</p>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>


@endsection