@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => 'Frequently Asked Questions']))
@endif

@section('content')

<main>
    {{ Breadcrumbs::render('page', $page->title) }}
    <section class="about-us-page">
        <div class="about-us-page__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="general-decor-text">about us</div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <div class="about-us-page__container">
                <div class="about-us-page__main-img js-img-bg" v-lazy:background-image="'{{ url($page->image_1) }}'"></div>
                <div class="about-us-page__content">
                    <h2 class="about-us-page__content__caption">{{ $page->title_1 }}</h2>
                    <p>{{ $page->content_1 }}</p>
                    <div class="main">
                        <p>{{ $page->q_1 }}</p>
                    </div>
                    <h2 class="about-us-page__content__caption">{{ $page->title_2 }}</h2>
                    <p>{{ $page->content_2 }}</p>
                    <div class="about-us-page__img-group about-us-page__img-group-tablet">
                        <div class="img js-img-bg" v-lazy:background-image="'{{ url($page->image_2) }}'"></div>
                        <div class="img js-img-bg" v-lazy:background-image="'{{ url($page->image_3) }}'"></div>
                    </div>
                    <p>{{ $page->content_3 }}</p>
                </div>
                <div class="about-us-page__img-group">
                    <div class="img js-img-bg" v-lazy:background-image="'{{ url($page->image_2) }}'"></div>
                    <div class="img js-img-bg" v-lazy:background-image="'{{ url($page->image_3) }}'"></div>
                </div>
            </div>
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
	<link href="{{ url('/css/csspages/about-us.css') }}" rel="preload" as="style">
@endpush

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush