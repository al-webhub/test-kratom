@php
	$deliveries = Aimix\Shop\app\Models\Delivery::active()->orderBy('created_at','desc')->get();
	$payments = Aimix\Shop\app\Models\Payment::active()->orderBy('created_at','desc')->get();
	
@endphp

@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => $page->title]))
@endif

@section('html_class', 'page-pay-deli')
@section('content')

<main>
    {{ Breadcrumbs::render('page', $page->title) }}
    <section class="pay-delivery">
        <div class="pay-deliver__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="general-decor-text">kratom helper</div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <ul class="pay-delivery__list">
                <li class="pay-delivery__item">
                    <div class="general-decor-caption">
                        <div class="img js-img-bg" v-lazy:background-image="'{{ url('/img/pay-delivery.png')}}'"></div>
                    </div>
                    <h2 class="main-caption-l">{!! $page->payment_info_title !!}</h2>
                    <ul class="delivery__list delivery__list-payment">
                        @foreach($payments as $payment)
                        <li class="delivery__item">
                            <div class="delivery__item__img" style="background-image:url({{ url($payment->image) }})"></div>
                            <p class="text">{{ $payment->name }}</p>
                        </li>
                        @endforeach
                        <li class="delivery__item">
                            <p class="text">{{ __('text.Another_Payment_Method') }}</p>
                        </li>
                    </ul>
                    {!! $page->payment_info !!}
                </li>
                <li class="pay-delivery__item">
                    <div class="general-decor-caption">
                        <div class="img delivery-times-img js-img-bg" v-lazy:background-image="'{{ url('/img/pay-delivery.png')}}'"></div>
                    </div>
                    <h2 class="main-caption-l">{!! $page->delivery_times_title !!}</h2>
                    
                    <ul class="delivery__list delivery__list-option">
	                    @foreach($deliveries->where('type', 'time') as $delivery)
                        <li class="delivery__item">
                            <p>{{ $delivery->name }} <span>({{ __('text.from') }} $ {{ $delivery->price }})</span></p>
                        </li>
                        @endforeach
                    </ul>
                    
                    {!! $page->delivery_times !!}
                </li>
                <li class="pay-delivery__item">
                    <div class="general-decor-caption">
                        <div class="img delivery-method-img js-img-bg" v-lazy:background-image="'{{ url('/img/pay-delivery.png')}}'"></div>
                    </div>
                    <h2 class="main-caption-l">{!! $page->delivery_method_title !!}</h2>
                    <ul class="delivery__list delivery__list-deliver">
	                    @foreach($deliveries->where('type', 'method') as $delivery)
                        <li class="delivery__item">
                            <p>{{ $delivery->name }}</p>
                        </li>
                        @endforeach
                    </ul>
                    {!! $page->delivery_method !!}
                </li>
            </ul>
        </div>
    </section>
    
    @if($page->seo_text)
    <section class="seo-block seo-block-main">
	    <div class="seo-block__wrapper container">
		{!! $page->seo_text !!}    
		</div>
    </section>
    @endif
    
    @include('layouts.modules.question')
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/pay-delivery.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
@endpush

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush