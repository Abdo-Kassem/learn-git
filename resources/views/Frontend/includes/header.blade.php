<?php
use Illuminate\Support\Facades\Request;
$segment = Request::segment(2); 
?>

<!-- Header -->
<header id="top-page" class="header">
    <div id="mainNav" class="main-menu-area animated">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-12 col-lg-2 d-flex justify-content-between align-items-center">
                    
                    <!-- Logo -->
                    
                    <div class="logo" style="width:100px">
                        
                        <a class="navbar-brand navbar-brand1" href="{{ route('home') }}">
                            <img src="{{asset('Frontend/images/screenshots/logo.png')}}" alt="Click Flex" data-rjs="2" />
                        </a>
                        
                        <a class="navbar-brand navbar-brand2" href="">
                            <img src="{{asset('Frontend/images/screenshots/logo.png')}}" alt="Click Flex" data-rjs="2" />
                        </a>
                    
                    </div>
                   
                    <!-- Burger menu -->
                    <div class="menu-bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    
                </div>
                
                <div class="op-mobile-menu col-lg-10 p-0 d-lg-flex align-items-center justify-content-end">
                    
                    <!-- Mobile menu -->
                    <div class="m-menu-header d-flex justify-content-between align-items-center d-lg-none">
                        
                        <!-- Logo -->
                        <!--
                        <a href="#" class="logo">
                            <img src="{{asset('Frontend/images/app-icon.png')}}" alt="Click Flex" data-rjs="2" />
                        </a>
                        -->
                        <!-- Close button -->
                        <span class="close-button"></span>
                        
                    </div>
                    
                    <!-- Items -->
                    <ul class="nav-menu d-lg-flex flex-wrap list-unstyled justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ ($segment == 'home' || $segment == null) ? 'active' : '' }}" href="{{ route('home') }}">
                                <span>{{ trans('backend.home') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('home') }}#screenshots">
                                <span>{{ trans('backend.screenshots') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ $segment == 'contact-us' ? 'active' : '' }}" href="{{ url('/contact-us') }}">
                                <span>{{ trans('backend.contact') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ $segment == 'privacy-policy' ? 'active' : '' }}" href="{{ url('/privacy-policy') }}">
                                <span>{{ trans('backend.privacy_policy') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ $segment == 'about' ? 'active' : '' }}" href="{{ url('/about') }}">
                                <span>{{ trans('backend.about') }}</span>
                            </a>
                        </li>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode != app()->getLocale())
                                <li class="nav-item lang">
                                    <a class="nav-link js-scroll-trigger" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        <span>{{ $properties['native'] }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <!--
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#support">
                                <span>Support</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#pricing">
                                <span>Pricing</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="blog.html">
                                <span>Blog</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#contact">
                                <span>Contact</span>
                            </a>
                        </li>
                        
                        <li class="nav-item search-option">
                            <a class="nav-link" href="#">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                        -->
                    </ul>
                    
                </div>
                
            </div>
        </div>
    </div>
    
</header>