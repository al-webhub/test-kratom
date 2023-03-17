@php
	$page = \Backpack\PageManager\app\Models\Page::find(11)->withFakes();
@endphp
@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => $page->title]))
@endif

@section('content')
<main>
    {{ Breadcrumbs::render('page', $page->title) }}
    <section class="our-advantages-page">
        <div class="our-advantages-page__wrapper container">
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <ul class="our-advantages__list">
                <li class="our-advantages__item" id="consultation">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-consultation js-img-bg" data-lazysrc="{{ url('/img/our-advantages__img.png')}}"></div>
                    </div>
                    <h2 class="our-advantages__caption">{!! $page->consultation_t !!}</h2>
                    <div class="our-advantages__text">{!! $page->consultation_c !!}</div>
                </li>
                <li class="our-advantages__item" id="delivery">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-delivery js-img-bg" data-lazysrc="{{ url('/img/our-advantages__img.png')}}"></div>
                    </div>
                    <h2 class="our-advantages__caption">{!! $page->delivery_t !!}</h2>
                    <div class="our-advantages__text">{!! $page->delivery_c !!}</div>
                </li>
                <li class="our-advantages__item" id="return">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-money js-img-bg" data-lazysrc="{{ url('/img/our-advantages__img.png')}}"></div>
                    </div>
                    <h2 class="our-advantages__caption">{!! $page->money_t !!}</h2>
                    <div class="our-advantages__text">{!! $page->money_c !!}</div>
                </li>
                <li class="our-advantages__item" id="quality">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-quality js-img-bg" data-lazysrc="{{ url('/img/our-advantages__img.png')}}"></div>
                    </div>
                    <h2 class="our-advantages__caption">{!! $page->quality_t !!}</h2>
                    <div class="our-advantages__text">{!! $page->quality_c !!}</div>
                </li>
            </ul>
        </div>
    </section>
    
    @if($page->seo_text)
    <section class="seo-block seo-block-main">
	    <div class="seo-block__wrapper container">
		    <div class="seo-block__container">
                {!! $page->seo_text !!}
            </div>   
		</div>
    </section>
    @endif
    
    @include('layouts.modules.question')
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/advantages.css') }}" rel="preload" as="style">
@endpush

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush