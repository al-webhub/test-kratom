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
    <section class="reviews-page">
        <div class="reviews__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="general-decor-text">kratom helper</div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            
            <reviews :data-reviews="reviews" :data-user="user" :data-product-id="null"></reviews>
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
	<link href="{{ url('/css/csspages/reviews.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
@endpush

@push('scripts')
<script>
  var reviews_data = @json($reviews);
  var user_data = @json($user);
</script>
<script src="{{ url('js/reviews/reviews.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush