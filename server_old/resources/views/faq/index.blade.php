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
    </section>
    <section class="faq">
        <div class="faq__wrapper container">
            <div class="general-decor-figure"></div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <p class="faq__text">{{ strip_tags($page->content) }}</p>
            <div class="faq__container">
                <ul class="faq__list">
                    @foreach($faqs as $key => $faq)
                    <li class="faq__item js-drop-item">
                        <div class="faq__item__header js-drop-button">
                            <h2 class="name">{{ $faq->title }}</h2>
                            <span class="icon-drop"></span>
                        </div>
                        <div class="faq__item__body">
                            {!! $faq->content !!}
                        </div>
                    </li>
                    @endforeach
                </ul>
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
	<link href="{{ url('/css/csspages/faq.css') }}" rel="preload" as="style">
@endpush

@push('scripts')

<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush