@extends('layouts.app')

@section('content')


<section id="main-content">
    <div class="row">
        <div class="col-md-12">
            
        	<div class="col-md-3 help-menu">
                <ul class="vertical-menu">
                    <li class="active"><a href="#faq" data-toggle="tab"><i class="fa fa-bullhorn"></i>Frequently Asked Questions</a></li>
                    <li><a href="#pricingFaq" data-toggle="tab"><i class="fa fa-money"></i>  Pricing FAQs</a></li>
                    <li><a href="#productFaq" data-toggle="tab"><i class="fa fa-gift"></i>  Product FAQs</a></li>
                    <li><a href="#why" data-toggle="tab"><i class="fa fa-exclamation-circle"></i> Why Choose CasterBuddy</a></li>
                    <li><a href="#question" data-toggle="tab"><i class="fa fa-question"></i> Other Questions</a></li>
                    <li><a href="#contact" data-toggle="tab"><i class="fa fa-phone"></i>  Contact Our Support </a></li>
                </ul>
        	</div>

            <div class="col-md-9">
                <div class="tab-content">
                    @include('pages.faq')
                    @include('pages.pricing_faq')
                    @include('pages.product_faq')
                    @include('pages.why')
                    @include('pages.question')
                    @include('pages.contact')
                </div>
            </div>
        </div>
    </div>
</section>















@endsection