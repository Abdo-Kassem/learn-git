@extends('Frontend.layouts.master')

@section('content')

    <!-- Banner -->
    @include('Frontend.includes._banner')


    <!-- Screenshots -->
    <section id="screenshots" class="bg-grey privacy-policy-page">

        <!-- Container -->
        <div class="container">

            <!-- Section title -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6">
                    
                    <div class="section-title text-center">
                        <h3 style="text-transform:capitalize">{{ trans('backend.privacy_policy_header') }}</h3>
                    </div>
                    
                </div>
            </div>

            <div class="tab-content translations-content-item en visible" id="en">
                <p style="font-size: 18px;">{!! app()->getLocale() == 'ar' ? $privacyPolicy->description_ar : $privacyPolicy->description_fr !!}</p>
            </div>

        </div>

    </section>
@endsection