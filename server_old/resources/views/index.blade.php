@extends('layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)

@section('content')

<main>
    <section class="main-banner main-slider">
        <home-banners :data-banners="banners"></home-banners>
    </section>
    <section class="product slider-infinity">
        <div class="product__wrapper container">
            <h2 class="main-caption">{{ __('text.featured') }}</h2>
            <!-- <infinity-slider :data-items="popular_products" data-type="productCard" data-link="/shop" data-button="view all products" data-class-list="product__list product-slider__list" data-class-item="product__item product-slider__item"></infinity-slider> -->
            <ul class="product__list product-slider__list js-infinity-slider-list">
                <li class="js-slider-item-infinity product__item product-slider__item" v-for="(item, index) in popular_products" :class="{show: index == 0}">
                    <productcard  :data-item="item"></productcard>
                </li>
            </ul>
            <div class="general-slider__buttons js-arrow-infinity">
                <button class="slider-button prev">
                    <span class="icon-arrow-left"></span>
                </button>
                
                <!-- Точки нужно выводить если они кратны 3 -->
                
                <div class="dots__list">
                    <div class="dots__item js-dot" :class="{active: (key + 1) == 3}" v-for="(item,key) in popular_products" v-if="(key + 1) % 3 == 0"></div>
                </div>
                
                <!-- //Точки нужно выводить если они кратны 3 -->
                <a href="{{ url_locale('shop') }}" class="main-button">
                    <span class="text">{{ __('text.view_all_products') }}</span>
                </a>
                <button class="slider-button next">
                    <span class="icon-arrow-right"></span>
                </button>
            </div>
        </div>
    </section>
    <section class="about-us-block">
        <div class="about-us-block__wrapper container">
            <p class="main-caption">{{ __('text.about_our_kratom') }}</p>
            <div class="general-decor-text">kratomhelper</div>
            <div class="general-decor-figure"></div>
            <div class="about-us-block__container">
                <div class="about-us-block__img">
                    <img alt="Фото" v-lazy="'{{ url('/glide/about-us-block-img-1.png?h=342&w=579&fm=pjpg&q=55') }}'">
                </div>
                <div class="about-us-block__text">
                    <span class="general-decor-elem"></span>
                    <div class="wrapper">
                        <p>{{ __('text.about_our_kratom_1') }}</p>
                    </div>
                    <a href="{{ url_locale('about_us') }}" class="main-button">
                        <span class="text">{{ __('text.learn_more') }}</span>
                    </a>
                </div>
            </div>
            <div class="about-us-block__description">
                <h2 class="main-caption-s">{{ __('text.Types_of_kratom') }}</h2>
                <p class="info">{{ __('text.Types_of_kratom_1') }}</p>
                <ul class="about-us-block__description__list">
                    <li class="about-us-block__description__item">
                        <div class="img">
                            <img v-lazy="'/glide/about-us-img-1.png?w=100&h=100'" alt="Kratom">
                        </div>
                        <h3 class="main-caption-xs">{{ __('text.Green_strain') }}</h3>
                        <p class="info">{{ __('text.Green_strain_1') }}</p>
                    </li>
                    <li class="about-us-block__description__item">
                        <div class="img">
                            <img v-lazy="'/glide/about-us-img-2.png?w=100&h=100'" alt="Kratom">
                        </div>
                        <h3 class="main-caption-xs">{{ __('text.Red_strain') }}</h3>
                        <p class="info">{{ __('text.Red_strain_1') }}</p>
                    </li>
                    <li class="about-us-block__description__item">
                        <div class="img">
                            <img v-lazy="'/glide/about-us-img-3.png?w=100&h=100'" alt="Kratom">
                        </div>
                        <h3 class="main-caption-xs">{{ __('text.White_strain') }}</h3>
                        <p class="info">{{ __('text.White_strain_1') }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="choose-kratom">
        <div class="choose-kratom__wrapper container">
            <div class="choose-kratom__info">
                <h2 class="main-caption">{{ __('text.choose_kratom_for_yourself') }}</h2>
                <span>{{ __('text.What_would_you_like?') }}</span>
            </div>
            <div class="choose-kratom__container">
                <div class="choose-kratom__filter">
                    <div class="choose-kratom__filter__item">
                        <p class="caption">{{ __('text.stimulation') }}</p>
                        <div class="choose-kratom__filter__select">
                            <button class="choose-kratom__filter__button" @click="calcMinus('stimulation')">
                                <span class="icon-minus"></span>
                            </button>
                            
                            <div class="choose-kratom__point" 
	                            	v-for="circle in 5" 
		                            :class="{active: calc.stimulation > (circle - 0.5), 'active-half': calc.stimulation == (circle - 0.5)}">
                                <span class="point-decor__wrapper">
                                    <span class="point-decor__inner"></span>
                                </span>
                            </div>
                            
                            <button class="choose-kratom__filter__button" @click="calcPlus('stimulation')">
                                <span class="icon-plus"></span>
                            </button>
                        </div>
                    </div>
                    <div class="choose-kratom__filter__item">
                        <p class="caption">{{ __('text.relaxation') }}</p>
                        <div class="choose-kratom__filter__select">
                            <button class="choose-kratom__filter__button" @click="calcMinus('relaxation')">
                                <span class="icon-minus"></span>
                            </button>
                            
                            <div class="choose-kratom__point"
	                            	v-for="circle in 5" 
		                            :class="{active: calc.relaxation > (circle - 0.5), 'active-half': calc.relaxation == (circle - 0.5)}">
                                <span class="point-decor__wrapper">
                                    <span class="point-decor__inner"></span>
                                </span>
                            </div>
                            
                            <button class="choose-kratom__filter__button" @click="calcPlus('relaxation')">
                                <span class="icon-plus"></span>
                            </button>
                        </div>
                    </div>
                    <div class="choose-kratom__filter__item">
                        <p class="caption">{{ __('text.euphoria') }}</p>
                        <div class="choose-kratom__filter__select">
                            <button class="choose-kratom__filter__button" @click="calcMinus('euphoria')">
                                <span class="icon-minus"></span>
                            </button>
                            <div class="choose-kratom__point"
	                            	v-for="circle in 5" 
		                            :class="{active: calc.euphoria > (circle - 0.5), 'active-half': calc.euphoria == (circle - 0.5)}">
                                <span class="point-decor__wrapper">
                                    <span class="point-decor__inner"></span>
                                </span>
                            </div>
                            <button class="choose-kratom__filter__button" @click="calcPlus('euphoria')">
                                <span class="icon-plus"></span>
                            </button>
                        </div>
                    </div>
                    <button class="main-button-color js-button" data-target="result-calc" @click="loadCalcItems()">
                        <span class="text">{{ __('text.choose_kratom') }}</span>
                    </button>
                </div>
                <div class="choose-kratom__table__wrapper">
                    <div class="choose-kratom__table">
                        <div class="choose-kratom__table__grid"></div>
                        <div class="choose-kratom__table__grid"></div>
                        <div class="choose-kratom__table__grid"></div>
                        <div class="choose-kratom__table__grid"></div>
                        <div class="choose-kratom__table__grid"></div>
                        <div class="choose-kratom__table__point stimulation" :style="{height: (calc.stimulation * 20) + '%'}">
                            <div class="point"></div>
                        </div>
                        <div class="choose-kratom__table__point relaxation" :style="{height: (calc.relaxation * 20) + '%'}">
                            <div class="point"></div>
                        </div>
                        <div class="choose-kratom__table__point euphoria" :style="{height: (calc.euphoria * 20) + '%'}">
                            <div class="point"></div>
                        </div>
                    </div>
                    <ul class="choose-kratom__table__list">
                        <li class="choose-kratom__table__item">{{ __('text.stimulation') }}</li>
                        <li class="choose-kratom__table__item">{{ __('text.relaxation') }}</li>
                        <li class="choose-kratom__table__item">{{ __('text.euphoria') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="our-advantages">
        <div class="our-advantages__wrapper container">
            <h2 class="main-caption">{{ __('text.Our_advantages') }}</h2>
            <div class="general-decor-text">kratomhelper</div>
            <ul class="our-advantages__list">
                <li class="our-advantages__item">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-consultation js-img-bg" v-lazy:background-image="'/glide/our-advantages__img.png'" ></div>
                    </div>
                    <p class="our-advantages__caption">{{ __('text.Consultation') }}</p>
                    <div class="our-advantages__text">{{ __('text.Our_advantages_1') }}</div>
                    <a href="{{ url_locale('our-advantages') }}" class="general-more">
                        <span class="text">{{ __('text.read_more') }}</span>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>
                <li class="our-advantages__item">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-delivery js-img-bg" v-lazy:background-image="'/glide/our-advantages__img.png'"></div>
                    </div>
                    <p class="our-advantages__caption">{{ __('text.Fast_delivery') }}</p>
                    <div class="our-advantages__text">{{ __('text.Our_advantages_2') }}</div>
                    <a href="{{ url_locale('our-advantages#delivery') }}" class="general-more">
                        <span class="text">{{ __('text.read_more') }}</span>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>
                <li class="our-advantages__item">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-money js-img-bg" v-lazy:background-image="'/glide/our-advantages__img.png'"></div>
                    </div>
                    <p class="our-advantages__caption">{{ __('text.Return_the_money') }}</p>
                    <div class="our-advantages__text">{{ __('text.Our_advantages_3') }}</div>
                    <a href="{{ url_locale('our-advantages#return') }}" class="general-more">
                        <span class="text">{{ __('text.read_more') }}</span>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>
                <li class="our-advantages__item">
                    <div class="our-advantages__img">
                        <div class="our-advantages__img-inner our-advantages__img-quality js-img-bg" v-lazy:background-image="'/glide/our-advantages__img.png'"></div>
                    </div>
                    <p class="our-advantages__caption">{{ __('text.Quality') }}</p>
                    <div class="our-advantages__text">{{ __('text.Our_advantages_4') }}</div>
                    <a href="{{ url_locale('our-advantages#quality') }}" class="general-more">
                        <span class="text">{{ __('text.read_more') }}</span>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <section class="article">
        <div class="article__wrapper container">
            <h2 class="main-caption">{{ __('text.articles') }}</h2>
            <ul class="article__list article__list-main">
                @foreach($articles as $article)
                <li class="article__item">
                    <div class="article__item__img">
                        <img v-lazy="'{{ url(str_replace('uploads', 'glide', $article->image) . '?h=200&w=300&fm=pjpg&q=50')  }}'" alt="{{ $article->title }}" title="{{ $article->title }}">
                    </div>
                    <p class="article__item__caption">{{ $article->title }}</p>
                    <div class="article__item__text">{{ $article->short_desc }}</div>
                    <a href="{{ $article->link }}" class="general-more">
                        <span class="text">{{ __('text.read_more') }}</span>
                        <span class="icon-arrow-right"></span>
                    </a>
                </li>
                @endforeach
            </ul>
            <a href="{{ url_locale('guidebook') }}" class="main-button">
                <span class="text">{{ __('text.go_guidebook') }}</span>
            </a>
        </div>
    </section>
    <section class="clients-say">
        <div class="clients-say__img js-img-bg" v-lazy:background-image="'{{ url('/glide/clients-say-bg.png?h=226&w=1423&fm=pjpg&q=55') }}'"></div>
        <div class="clients-say__wrapper container slider-infinity">
            <h2 class="main-caption">{{ __('text.What_our_clients_say') }}</h2>
            <div class="clients-say__header">
                <p class="clients-say__caption">{{ __('text.leave_feedback_and_earn') }}</p>
                <div class="clients-say__buttons">
                    <a href="{{ url_locale('reviews#feedback') }}" class="main-button-color">
                        <span class="text">{{ __('text.leave_feedback') }}</span>
                    </a>
                    <a href="{{ url_locale('rewards') }}" class="main-button-color clients-say__button">
                        <span class="text">{{ __('text.learn_more') }}</span>
                    </a>
                </div>
            </div>
            
            <!-- <infinity-slider :data-items="reviews" data-type="reviewCard" data-link="/reviews" data-button="read all reviews" data-class-list="clients-say__list" data-class-item="clients-say__item js-item"></infinity-slider> -->
            <ul class="clients-say__list js-infinity-slider-list">
                <li class="js-slider-item-infinity clients-say__item js-item" v-for="(item, index) in reviews" :class="{show: index == 0}">
                    <reviewcard  :data-item="item"></reviewcard>
                </li>
            </ul>
            <div class="general-slider__buttons js-arrow-infinity">
                <button class="slider-button prev">
                    <span class="icon-arrow-left"></span>
                </button>
                
                <!-- Точки нужно выводить если они кратны 3 -->
                
                <div class="dots__list">
                    <div class="dots__item js-dot" :class="{active: (key + 1) == 3}" v-for="(item,key) in reviews" v-if="(key + 1) % 3 == 0"></div>
                </div>
                
                <!-- //Точки нужно выводить если они кратны 3 -->
                <a href="{{ url_locale('reviews') }}" class="main-button">
                    <span class="text">{{ __('text.read_all_reviews') }}</span>
                </a>
                <button class="slider-button next">
                    <span class="icon-arrow-right"></span>
                </button>
            </div>
        </div>
    </section>
    <section class="follow-us">
        <div class="follow-us__wrapper container">
            <div class="general-decor-text">social kratom</div>
            <div class="general-decor-figure"></div>
            <h2 class="main-caption">{{ __('text.follow')  }} <br> {{ __('text.us')  }}</h2>
            <div class="follow-us__container slider">
                <div class="follow-us__phone">
                    <ul class="follow-us__list">
                        <li class="follow-us__item js-slider-item show js-img-bg" v-lazy:background-image="'/glide/follow-us-phone-img.png?h=308&w=141&fm=pjpg&q=55'" data-index="1"></li>
                        <li class="follow-us__item js-slider-item js-img-bg" v-lazy:background-image="'/glide/follow-us-phone-img-facebook.png?h=308&w=141&fm=pjpg&q=55'" data-index="2"></li>
                    </ul>
                </div>
                <div class="follow-us__tablet">
                    <ul class="follow-us__list">
                        <li class="follow-us__item js-slider-item-else show js-img-bg" v-lazy:background-image="'/glide/follow-us-tablet-img.png?h=330&w=553&fm=pjpg&q=55'" data-index="1"></li>
                        <li class="follow-us__item js-slider-item-else js-img-bg" v-lazy:background-image="'/glide/follow-us-tablet-img-facebook.png?h=330&w=553&fm=pjpg&q=55'" data-index="2"></li>
                    </ul>
                </div>
                <div class="follow-us__social-wrapper">
                    <ul class="follow-us__social-list">
                        <li class="follow-us__social-item js-socila-item" data-index="1">
                            <a href="{{ config('settings.inst') }}" class="general-more">
                                <span class="text">instagram</span>
                                <span class="icon-arrow-right"></span>
                            </a>
                        </li>
                        <li class="follow-us__social-item js-socila-item" data-index="2">
                            <a href="{{ config('settings.fb') }}" class="general-more">
                                <span class="text">facebook</span>
                                <span class="icon-arrow-right"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="follow-us__arrows js-arrows">
                    <button class="slider-button slider-button-small prev disabled">
                        <span class="icon-arrow-left"></span>
                    </button>
                    <div class="dots__list">
                        <div class="dots__item active js-dot" data-index="1"></div>
                        <div class="dots__item js-dot" data-index="2"></div>
                    </div>
                    <button class="slider-button slider-button-small next">
                        <span class="icon-arrow-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section class="seo-block seo-block-main">
        <div class="seo-block__wrapper container">
            <h1 class="main-caption">{!! $page->h1 !!}</h1>
            <div class="seo-block__container">
                {!! $page->seo_text !!}
            </div>
        </div>
    </section>
    @include('layouts.modules.question')
    <section class="popup popup-reviews" data-target="reviews">
        <button class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <div class="popup-reviews__wrapper">
            <span class="general-decor-elem"></span>
        </div>
    </section>
    
    
    <section class="popup popup-result-calc" data-target="result-calc">
        <button class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <div class="popup-result-calc__header">
            <p class="main-caption">{{ __('text.kratom_for_you') }}</p>
            <a href="{{ route('shop') }}" class="general-more">
                <span class="text">{{ __('text.shop') }}</span>
                <span class="icon-arrow-right"></span>
            </a>
        </div>
        <div class="popup-result-calc__body">
            <ul class="product__list">
                
                <li class="product__item" :data-index="key + 1" v-for="(product,key) in for_you">
                	<productcard :data-item="product"></productcard>
                </li>
                
            </ul>
        </div>
    </section>
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/home.css') }}" rel="preload">
@endpush
@push('scripts')
<script>
	var reviews = @json($reviews);
	var banners = @json($banners);
	var popular_products = @json( \App\Http\Resources\Product::collection($popular_products), JSON_INVALID_UTF8_IGNORE );
</script>
<script async src="{{ url('js/jspages/home.js') }}"></script>
<script async src="{{ url('js/jspages/native/index.js') }}"></script>
<!-- <script async src="{{ url('js/index/index.js') }}"></script> -->
@endpush