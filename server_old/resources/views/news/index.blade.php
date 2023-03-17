@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => 'Frequently Asked Questions']))
@endif

@section('content')
<main>
    {{ Breadcrumbs::render('guidebook') }}
    <section class="gidebook">
        <div class="gidebook__wrapper container">
            <div class="general-decor-figure"></div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <div class="article__position">
                <ul class="article__list article__list-gidebook">
                    <li class="article__item" v-for="(article, key) in articles.data">
                        <div class="article__item__img">
                            <img v-lazy="article.image" :alt="article.title" :title="article.title">
                        </div>
                        <p class="article__item__caption">@{{ article.title }}</p>
                        <div class="article__item__text" v-html="article.short_desc"></div>
                        <a :href="article.link" class="general-more">
                            <span class="text">{{ __('text.read_more') }}</span>
                            <span class="icon-arrow-right"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="main-button" @click="loadmore()" v-if="articles.current_page != articles.last_page">
                <span class="text">{{ __('text.show_more') }}</span>
            </button>
            
            @if($page->seo_text)
            <div class="gidebook__text">
	            {!! $page->seo_text !!}  
            </div>
			@endif
        </div>
    </section>
    @include('layouts.modules.question')
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/articles.css') }}" rel="preload" as="style">
@endpush

@push('scripts')
<script>
  var articles = @json($articles);
</script>
<script src="{{ url('js/news/news.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush