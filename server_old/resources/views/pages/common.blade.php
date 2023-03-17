@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => $page->title]))
@endif

@section('content')
<main>
	<section class="article-page">
		<div id="information-information" class="container-maxwidth">
		  
		  <div class="row">
		    <div class="col-xs-12">
		    {{ Breadcrumbs::render('page', $page->title) }}
		    </div>
		  </div>
		
		  <div class="container">
		    <div class="col-sm-12">
		      <div class="article-page__content">
			      <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
				  {!! $page->content !!}
		      </div>
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
	<link href="{{ url('/css/csspages/article.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
@endpush

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
@endpush