<!DOCTYPE html>
<html class="no-js" lang="en-US">
	
	<head>
		
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Title -->
		<title>{{ trans('backend.website_name') }}</title>

		<!-- Favicon -->
		<link rel="icon" href="{{asset('Frontend/images/screenshots/logo.png')}}" type="image/x-icon">
		
		<!-- Google web font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,700">
		
		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/bootstrap/css/bootstrap.min.css')}}">
		
		<!-- Font awesome -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/fontawesome/css/all.min.css')}}">
		
		<!-- Linea icons -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/linea/arrows/styles.css')}}" />
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/linea/basic/styles.css')}}" />
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/linea/ecommerce/styles.css')}}" />
        <link rel="stylesheet" href="{{asset('Frontend/assets/library/linea/software/styles.css')}}" />
        <link rel="stylesheet" href="{{asset('Frontend/assets/library/linea/weather/styles.css')}}" />
		
		<!-- Animate -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/animate/animate.css')}}">
		
		<!-- Lightcase -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/lightcase/css/lightcase.css')}}">
		
		<!-- Swiper -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/swiper/swiper-bundle.min.css')}}">
		
		<!-- Owl carousel -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/owlcarousel/owl.carousel.min.css')}}">
		
		<!-- Slick carousel -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/slick/slick.css')}}">
		
		<!-- Magnific popup -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/magnificpopup/magnific-popup.css')}}">
		
		<!-- YTPlayer -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/library/ytplayer/css/jquery.mb.ytplayer.min.css')}}">
		
		<!-- Stylesheet -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/css/style.css')}}">
		@if(app()->getLocale() == 'ar')
			<link rel="stylesheet" href="{{asset('Frontend/assets/css/style_rtl.css')}}">
		@else 
			<style>
				.banner:before {
					/*background:linear-gradient(-47deg, #7c4fe0 0%, #4528dc 100%);*/
					background: linear-gradient(-15deg, #007c20 0%, #6cff8b 87%);
				}
			</style>
		@endif
		<link rel="stylesheet" href="{{asset('Frontend/assets/css/media.css')}}">
		
		<!-- Color schema -->
		<link rel="stylesheet" href="{{asset('Frontend/assets/colors/blue.css')}}" class="colors">
		
	</head>

	<body>

		<!-- Loader -->
		<div class="page-loader">
			<div class="progress"></div>
		</div>

		@include('Frontend.includes.header')
		
		<!-- Search wrapper -->
		<!--
		<div class="search-wrapper">

			
			<form role="search" method="get" class="search-form" action="#">				
				<input type="search" name="s" id="s"
					   placeholder="Search Keyword"
					   class="searchbox-input" autocomplete="off" required />
				
				<span>Input your search keywords and press Enter.</span>			
			</form>

			
			<div class="search-wrapper-close">
				<span class="search-close-btn"></span>
			</div>

		</div>
		-->

		@yield('content')

		@include('Frontend.includes.footer')

        <!-- Back to top -->
		<a href="#top-page" class="to-top">
			<div class="icon icon-arrows-up"></div>
		</a>

		@include('Frontend.layouts.scripts')

		<script>
			$(document).ready(function() {

				// Success Message ...
				@if( session()->has('success') )
					swal({
						title: "{!! session()->get("success") !!}",
						icon: "success",
						button : "{!! trans('backend.ok') !!}"
					});
				@endif

				// Error Message ...
				@if( session()->has('error') )
					swal({
						title: "{!! session()->get("error") !!}",
						icon: "error",
						button : "{!! trans('backend.ok') !!}"
					});
				@endif

				// Warning Message ...
				@if( session()->has('warning') )
					swal({
						title: "{!! session()->get("warning") !!}",
						icon: "warning",
						button : "{!! trans('backend.ok') !!}"
					});
				@endif

				// Confirm Delete .... ??!
				$(document).on('click' , '.delete' ,function(e){

					e.preventDefault();

					var that = $(this);

					swal({
						title: "Confirm Delete !",
						icon: "error",
						buttons: ["No", "Yes"],
						dangerMode: true,
					})
					.then((willDelete) => {
					if (willDelete) {
							that.closest('form').submit();
						}
					});

				});

			

				// Confirm Delete .... ??!
				$(document).on('click' , '.confirm_logout' ,function(e){

					e.preventDefault();

					var that = $(this);

					swal({
						title: "{{ trans('backend.confirm_logout') }}",
						icon: "info",
						buttons: ["{{ trans('backend.no') }}", "{{ trans('backend.yes') }}"],
						dangerMode: true,
					})
					.then((willDelete) => {
					if (willDelete) {
							that.closest('form').submit();
						}
					});

				});

			} );
		</script>

	</body>
	
</html>