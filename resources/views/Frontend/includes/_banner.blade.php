<section id="home" class="banner image-bg" style='padding-top:115px'>
                
    <!-- Container -->
    <div class="container">
        
        <div class="row align-items-center">

            <!-- Content -->
            <div class="col-12 col-lg-6 res-margin">

                <!-- Banner text -->
                <div class="banner-text">

                    <h1 class="wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0s">
                       {{ trans('backend.website_name') }}
                    </h1>
                    
                    <p class="wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0.3s" style='font-size: 25px;text-transform: uppercase;font-weight: 400;'>
                        {{ trans('backend.banner_content1') }}<br>
                        {{ trans('backend.banner_content2') }}<br>
                        {{ trans('backend.banner_content3') }} 
                    </p>

                    <div class="button-store wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0.6s">
                        
                        <a href="#" class="custom-btn d-inline-flex align-items-center m-2 m-sm-0 me-sm-3">
                            <i class="fab fa-google-play"></i><p>Available on<span>Google Play</span></p>
                        </a>
                        
                        <a href="#" class="custom-btn d-inline-flex align-items-center m-2 m-sm-0">
                            <i class="fab fa-apple"></i><p>Download on<span>App Store</span></p>
                        </a>
                    
                    </div>

                </div>
            
            </div>
            
            <!-- Image -->
            <div class="col-12 col-lg-6 image-container">
        
                <div class="banner-image wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0.3s">
                    <img style='max-width:300px'class="bounce-effect" src="{{asset('Frontend/images/screenshots/3.png')}}" alt="" />
                </div>

            </div>
            
        </div>
        
    </div>
    
    <!-- Wave effect -->
    <div class="wave-effect wave-anim">
        
        <div class="waves-shape shape-one">
            <div class="wave wave-one"></div>
        </div>
        
        <div class="waves-shape shape-two">
            <div class="wave wave-two"></div>
        </div>
        
        <div class="waves-shape shape-three">
            <div class="wave wave-three"></div>
        </div>
        
    </div>
    
</section>