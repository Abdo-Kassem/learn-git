<!-- Footer -->
<footer>
			
    <!-- Widgets -->
    <div class="footer-widgets">
        <div class="container">
            
            <div class="row">
                
                <!-- Footer logo -->
                <div class="col-12 col-md-6 col-lg-4 res-margin">
                    <div class="widget">
                        <p class="footer-logo" style="width:100px">
                            <img src="{{asset('Frontend/images/screenshots/logo.png')}}" alt="Click Flex" data-rjs="2">
                        </p>
                        <p>
                            {{ trans('backend.footer_description') }}
                        </p>
                        
                        <!-- Social links -->
                        <div class="footer-social">
                            <a href="https://wa.me/{{ $setting->whatsapp_number }}" title="Twitter"><i class="fab fa-whatsapp fa-fw"></i></a>
                            <a href="{{ $setting->facebook }}" title="Facebook"><i class="fab fa-facebook-f fa-fw"></i></a>
                            <a href="{{ $setting->instagram }}" title="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Useful links -->
                <div class="col-12 col-md-6 col-lg-3 offset-lg-1 res-margin">
                    <div class="widget">
                        
                        <h6>{{ trans('backend.useful_links') }}</h6>
                        
                        <ul class="footer-menu">
                            <!--
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                            <li><a href="#">Careers</a></li>
                            -->
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger active" href="#top-page">
                                    <span>{{ trans('backend.home') }}</span>
                                </a>
                            </li>
                            <!--
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#features">
                                    <span>Features</span>
                                </a>
                            </li>
                            -->
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#screenshots">
                                    <span>{{ trans('backend.screenshots') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="{{ url('/contact-us') }}">
                                    <span>{{ trans('backend.contact') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="{{ url('/privacy-policy') }}">
                                    <span>{{ trans('backend.privacy_policy') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="{{ route('frontend.my-account.index') }}">
                                    <span>{{ trans('backend.delete_my_account') }}</span>
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                
                <!-- Product help -->
                <!--
                <div class="col-12 col-md-6 col-lg-3 res-margin">
                    <div class="widget">
                        
                        <h6>Product Help</h6>
                        
                        <ul class="footer-menu">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Reviews</a></li>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Feedback</a></li>
                            <li><a href="#">API</a></li>
                        </ul>
                        
                    </div>
                </div>
                -->
                <!-- Download -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="widget">
                        
                        <h6>{{ trans('backend.download') }}</h6>
                        
                        <div class="button-store">
                            <a href="#" class="custom-btn d-inline-flex align-items-center m-2 m-sm-0 mb-sm-3"><i class="fab fa-google-play"></i><p>Available on<span>Google Play</span></p></a>
                            <a href="#" class="custom-btn d-inline-flex align-items-center m-2 m-sm-0"><i class="fab fa-apple"></i><p>Download on<span>App Store</span></p></a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="footer-copyright">				
        <div class="container">
            
            <div class="row">						
                <div class="col-12">
                    
                    <!-- Text -->
                    <p class="copyright text-center">
                        {{ trans('backend.copyright') }} © 2024 <a href="{{ url('/') }}" target="_blank">{{ trans('backend.website_name') }}</a>. {{ trans('backend.all_rights_reserved') }}.
                    </p>
                    
                </div>
            </div>
            
        </div>				
    </div>
    
</footer>