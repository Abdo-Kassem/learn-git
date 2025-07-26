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
                        <h3>Delete My Account Now</h3>
                        
                    </div>
                    
                </div>
            </div>
        
            <div class="row">
                
                <div class="col-md-6 offset-md-3">
                    
                    <form action="{{ route('frontend.my-account.delete') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        
                        
                        @if( session()->has('my_account') )

                            <div class="accont-info">
                                <p>Name: {{ session()->get('my_account')->first_name }} {{ session()->get('my_account')->last_name }}</p>
                                <p>Email: {{ session()->get('my_account')->email }}</p>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12 mt-2">
                                    <button type="submit" id="contact-submit" name="send" class="btn w-100 delete">Delete My Account Now</button>
                                </div>
                            </div>
                        @else
                            Go To Link Delete My Account In Footer .
                        @endif
                        
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