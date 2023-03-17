@php
	$hreflangs = get_hreflands();
	$lang = Session::get('lang');
	//dd($languages_ul);
@endphp

@extends('layouts.app')

@if($article->meta_title)
	@section('meta_title', $article->meta_title)
@else
	@section('meta_title', $article->title)
@endif

@if($article->meta_description)
	@section('meta_description', $article->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => $article->title]))
@endif

@section('hreflang')
	@if($lang == 'en-us' || $lang == 'en-gh')
		@foreach($hreflangs as $iso => $url)
			@if($iso != 'ru-kz')
				<link rel="alternate" hreflang="{{ $iso }}" href="{{ url($url) }}"/>
			@endif
		@endforeach
	@else
	&nbsp;
	@endif
@endsection

@section('content')
<main>
    {{ Breadcrumbs::render('article', $article->title) }}
    <section class="article-page">
        <div class="article-page__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="general-decor-figure"></div>
            <div class="general-decor-text">kratom helper</div>
            <div class="article-page__img">
                <img v-lazy="'{{ url( str_replace('uploads', 'glide', $article->image) . '?h=400&w=1290&fit=crop') }}'" title="{{ $article->title }}" alt="{{ $article->title }}">
            </div>
            <div class="article-page__content">
                {{--<p class="date">{{ $article->toArray()['date'] }}</p> --}}
                <h1 class="main-caption main-caption-align">{{ $article->title }}</h1>
                {!! $article->content !!}
                <a href="{{ url('guidebook') }}" class="general-more">
                    <span class="icon-arrow-left"></span>
                    <span class="text">{{ __('text.back_to_all_articles') }}</span>
                </a>
            </div>
            
        </div>
        <div class="articel-page__similar container">
            <p class="articel-page__caption">{{ __('text.similar_articles') }}</p>
            <ul class="article__list article__list-main">
                @foreach($similars as $similar)
                <li class="article__item">
                    <div class="article__item__img">
                        <img v-lazy="'{{ url(str_replace('uploads', 'glide', $similar->image) . '?h=200&w=300&fm=pjpg&q=90') }}'" alt="{{ $similar->title }}" title="{{ $similar->title }}">
                    </div>
                    <p class="article__item__caption">{{ $similar->title }}</p>
                    <div class="article__item__text">{{ $similar->short_desc }}</div>
                    <a href="{{ $similar->link }}" class="general-more">
                        <span class="text">{{ __('text.read_more') }}</span>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
</main>

@endsection

@push('styles')
	<link href="{{ url('/css/csspages/article.css?v=1.1') }}" rel="preload" as="style">
@endpush

@push('scripts')
<script src="{{ url('js/news/singleNews.js?v=1.1') }}"></script>
<script src="{{ url('js/jspages/native/common.js?v=1.1') }}"></script>
@endpush