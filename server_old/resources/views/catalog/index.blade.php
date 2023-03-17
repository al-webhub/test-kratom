@extends('layouts.app')

@section('meta_title', $currentCategory->meta_title)

@if($currentCategory->meta_description)
	@section('meta_description', $currentCategory->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => $currentCategory->name]))
@endif

@section('content')
<main>
    {{ Breadcrumbs::render('shop') }}
    <section class="shop-page">
        <div class="shop-page__wrapper container">
            <div class="general-decor-figure"></div>
            <h1 class="main-caption main-caption-align">@{{ pageH1 }}</h1>
            <ul class="general-tabs__list">
                <li class="general-tabs__item" :class="{active: query.category == category.id}" v-for="(category, index) in categories" @click="query.category = category.id">@{{ category.name }}</li>
            </ul>
            <div class="product__position">
                <ul class="product__list">
                    <li class="product__item" v-for="product in categoryProducts">
                        <productcard :data-item="product"></productcard>
                    </li>
                </ul>
            </div>
            <button class="main-button" @click="loadmore()" v-if="products.current_page != products.last_page">
                <span class="text">{{ __('text.show_more') }}</span>
            </button>
        </div>
    </section>
    
    
    <section class="seo-block seo-block-main" v-if="categories[query.category].description">
	    <div class="seo-block__wrapper container">
<!--             <div class="main-caption">Kratom tea for sale</div> -->
            <div class="seo-block__container" v-html="categories[query.category].description"></div>
		</div>
    </section>
    
    @include('layouts.modules.question')
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/shops.css') }}" rel="preload" as="style">
@endpush
@push('scripts')
<script>
  var categories = @json($categories);
  var products = @json($products, JSON_INVALID_UTF8_IGNORE);
  var currentCategoryId = @json($currentCategory->id);
</script>
<script src="{{ url('js/catalog/catalog.js?v=1.0') }}"></script>
<script src="{{ url('js/jspages/native/shops.js') }}"></script>
@endpush