@extends('layouts.app')

@section('meta_title', $product->mTitle)
@section('meta_description', $product->mDescription)

@section('content')
<script type="application/ld+json">
{
  "@context": "http://schema.org/", 
  "@type": "Product", 
  "name": "{{ $product->name }}",
  "image": "{{ url($product->image) }}",
  "description": "{!! $product->description !!}",
  "brand": "Kratom",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "USD",
    "Price":"{{ $product->price }}",
    "availability": "InStock",
    "url": "{{ $product->link }}"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "135"
  }
}
</script>

<main>
    {{ Breadcrumbs::render('product', $product->name) }}
    <section class="product-page">
        <div class="product-page__wrapper container">
            <h1 class="main-caption main-caption-align">@{{ product.name }}</h1>
            <div class="product-page__header">
				<!-- update -->
                <div class="product-page__img slider">
                    <ul class="product-page__img-list">
                        <li class="product-page__img-item js-slider-item show">
                            <img :title="product.name" :alt="product.name" v-lazy="product.image">
                        </li>
                        <li class="product-page__img-item js-slider-item" v-for="img in product.images">
                            <img :title="product.name" :alt="product.name" v-lazy="img">
                        </li>
                    </ul>
                    <div class="product-page__img-arrows js-arrows" v-if="Object.keys(product.images).length">
                        <button class="slider-button prev">
                            <span class="icon-arrow-left"></span>
                        </button>
                        <button class="slider-button next">
                            <span class="icon-arrow-right"></span>
                        </button>
                    </div>
                    <div class="dots__list" v-if="Object.keys(product.images).length">
                        <div class="dots__item active js-dot"></div>
                        <div class="dots__item js-dot" v-for="img in product.images"></div>
                    </div>
                </div>
                <!-- /update -->
                <div class="product-page__info">
                    <div class="product-page__info-header">
                        <div class="product-page__info-choose">
                            <ul class="product__weight-list">
                                <li class="product__weight-item" @click="changeModification(modification)" :class="{active: modification.id === selectedModification.id}" v-for="(modification, key) in product.modifications">@{{ modification.name }}</li>
                            </ul>
                            <div class="product-page__price-wrapper">
                                <div class="wrapper">
                                    <p class="product-page__price">{{ config('aimix.currency.'.Session::get('lang'), 'USD') }} <span>@{{ selectedModification.price * selectedModification.amount }}</span></p>
                                    <div class="product__calc">
                                        <button class="calc_button" @click="(selectedModification.amount > 1)? selectedModification.amount-- : false">
                                            <span class="text">-</span>
                                        </button>
                                        <input type="text" class="calc-input" value="1" v-model="selectedModification.amount">
                                        <button class="calc_button" @click="selectedModification.amount++">
                                            <span class="text">+</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="product-page__info-sale product-page__info-sale-mobile" v-if="product.modifications[1]">
                                    <p class="current-dis">{{ __('text.current_DISCOUNT') }}: <span>@{{ currentDiscount }}%</span></p>
                                    <p class="sale">{{ __('text.save') }} @{{ discounts.slice(-1)[0] }}%</p>
                                    <p class="offer">{{ __('text.Order') }} @{{ saleWeights }} <br>{{ __('text.and') }} <span>{{ __('text.get_a_discount') }}</span> @{{ discountsString }}</p>
                                </div>
                                <button class="main-button-color" @click="addToCart(product.id, selectedModification)">
                                    <span class="text">{{ __('text.add_to_cart') }}</span>
                                </button>
                            </div>
                        </div>
                        <div class="product-page__info-sale" v-if="product.modifications[1]">
                            <p class="current-dis">{{ __('text.current_DISCOUNT') }}: <span>@{{ currentDiscount }}%</span></p>
                            <p class="sale">{{ __('text.save') }} @{{ discounts.slice(-1)[0] }}%</p>
                            <p class="offer">{{ __('text.Order') }} @{{ saleWeights }} <br>{{ __('text.and') }} <span>{{ __('text.get_a_discount') }}</span> @{{ discountsString }}</p>
                        </div>
                    </div>
                    
                    <div class="product-page__info-footer">
                        <div class="choose-kratom__filter"  v-if="product.stimulation != null && product.relaxation != null && product.euphoria != null">
                            <div class="choose-kratom__filter__item">
                                <p class="caption">{{ __('text.stimulation') }}</p>
                                <div class="choose-kratom__filter__select">
                                    <button class="choose-kratom__filter__button" @click="changeAttr('stimulation', -1)" :class="{disabled: storage && storage[product.id] && storage[product.id]['stimulation'] == -1 || product.stimulation == '0%'}">
                                        <span class="icon-minus"></span>
                                    </button>
                                    
                                    <div class="choose-kratom__point" 
	                                    	v-for="point in 5"
		                                    :class="{
			                                    active: product.stimulation > (point * 20 - 10), 
				                                'active-half': (product.stimulation <= (point * 20 - 10) && product.stimulation > (point * 20 - 20))
					                        }">
                                        <span class="point-decor__wrapper">
                                            <span class="point-decor__inner"></span>
                                        </span>
                                    </div>
                                    
                                    <button class="choose-kratom__filter__button" @click="changeAttr('stimulation', 1)" :class="{disabled: storage && storage[product.id] && storage[product.id]['stimulation'] == 1 || product.stimulation == '100%'}">
                                        <span class="icon-plus"></span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="choose-kratom__filter__item">
                                <p class="caption">{{ __('text.relaxation') }}</p>
                                <div class="choose-kratom__filter__select">
                                    <button class="choose-kratom__filter__button" @click="changeAttr('relaxation', -1)" :class="{disabled: storage && storage[product.id] && storage[product.id]['relaxation'] == -1 || product.relaxation == '0%'}">
                                        <span class="icon-minus"></span>
                                    </button>
                                    
                                    <div class="choose-kratom__point" 
	                                    	v-for="point in 5"
		                                    :class="{
			                                    active: product.relaxation > (point * 20 - 10), 
				                                'active-half': (product.relaxation <= (point * 20 - 10) && product.relaxation > (point * 20 - 20))
					                        }">
                                        <span class="point-decor__wrapper">
                                            <span class="point-decor__inner"></span>
                                        </span>
                                    </div>
                                    
                                    <button class="choose-kratom__filter__button" @click="changeAttr('relaxation', 1)" :class="{disabled: storage && storage[product.id] && storage[product.id]['relaxation'] == 1 || product.relaxation == '100%'}">
                                        <span class="icon-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="choose-kratom__filter__item">
                                <p class="caption">{{ __('text.euphoria') }}</p>
                                <div class="choose-kratom__filter__select">
                                    <button class="choose-kratom__filter__button" @click="changeAttr('euphoria', -1)" :class="{disabled: storage && storage[product.id] && storage[product.id]['euphoria'] == -1 || product.euphoria == '0%'}">
                                        <span class="icon-minus"></span>
                                    </button>
                                    
                                    <div class="choose-kratom__point" 
	                                    	v-for="point in 5"
		                                    :class="{
			                                    active: product.euphoria > (point * 20 - 10), 
				                                'active-half': (product.euphoria <= (point * 20 - 10) && product.euphoria > (point * 20 - 20))
					                        }">
                                        <span class="point-decor__wrapper">
                                            <span class="point-decor__inner"></span>
                                        </span>
                                    </div>
                                    
                                    <button class="choose-kratom__filter__button" @click="changeAttr('euphoria', 1)" :class="{disabled: storage && storage[product.id] && storage[product.id]['euphoria'] == 1 || product.euphoria == '100%'}">
                                        <span class="icon-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-page__info-text"  v-if="product.stimulation != null && product.relaxation != null && product.euphoria != null">
                            <p>{{ __('text.Users_take') }}</p>
                            <p>{{ __('text.As_soon_as') }}</p>
                        </div>
                        <button class="general-more js-button" data-target="delivery">
                            <span class="text">{{ __('text.pay_delivery') }}</span>
                            <span class="icon-arrow-right"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="product-page__body">
                <ul class="general-tabs__list">
                    <li class="general-tabs__item js-product-tab active" data-target="description">{{ __('text.description') }}</li>
                    <li class="general-tabs__item js-product-tab" data-target="reviews">{{ __('text.reviews') }}</li>
                </ul>
                <div class="product-page__description js-product-item" data-target="description">
                    <p class="product-page__caption">{{ __('text.description') }}</p>
                    <div v-html="product.description"></div>
                </div>
                
                
                <!-- REVIEWS -->
                <reviews :data-reviews="reviews" :data-user="user" :data-product-id="product.id"></reviews>
                <!-- REVIEWS -->
                
                
            </div>
        </div>
    </section>
    
    
    
    <section class="product slider-infinity">
        <div class="product__wrapper container">
            <div class="product__wrapper_header">
                <p class="main-caption">{{ __('text.related_products') }}</p>
                <a href="{{ route('shop') }}" class="general-more">
                    <span class="text">{{ __('text.shop') }}</span>
                    <span class="icon-arrow-right"></span>
                </a>
            </div>
            <ul class="product__list product-slider__list js-infinity-slider-list">
                <li class="product__item product-slider__item show js-slider-item-infinity" :data-index="key + 1" v-for="(product,key) in popular_products">
                    <productcard :data-item="product"></productcard>
                </li>
            </ul>
            <div class="general-slider__buttons general-slider__buttons-product-page js-arrow-infinity" :class="{hide: popular_products.length < 5}">
                <button class="slider-button prev">
                    <span class="icon-arrow-left"></span>
                </button>
                
                <!-- Точки нужно выводить если они кратны 3 -->
                <div class="dots__list">
                    <div class="dots__item js-dot" :class="{active: (key + 1) == 3}" v-for="(item,key) in popular_products" v-if="(key + 1) % 3 == 0"></div>
                </div>
                
                <!-- //Точки нужно выводить если они кратны 3 -->
                <button class="slider-button next">
                    <span class="icon-arrow-right"></span>
                </button>
            </div>
        </div>
    </section> 
    
    @if($recently)
    <section class="product slider-infinity">
        <div class="product__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="product__wrapper_header">
                <p class="main-caption">{{ __('text.recently_viewed') }}</p>
                <a href="{{ route('shop') }}" class="general-more">
                    <span class="text">{{ __('text.shop') }}</span>
                    <span class="icon-arrow-right"></span>
                </a>
            </div>
            <ul class="product__list product-slider__list js-infinity-slider-list">
                <li class="product__item product-slider__item show js-slider-item-infinity" :data-index="key + 1" v-for="(product,key) in recently_viewed">
                    <productcard :data-item="product"></productcard>
                </li>
            </ul>
            <div class="general-slider__buttons general-slider__buttons-product-page js-arrow-infinity" :class="{hide: recently_viewed.length < 5}">
                <button class="slider-button prev">
                    <span class="icon-arrow-left"></span>
                </button>
                
                <!-- Точки нужно выводить если они кратны 3 -->
                
                <div class="dots__list">
                    <div class="dots__item js-dot" :class="{active: (key + 1) == 3}" v-for="(item,key) in recently_viewed" v-if="(key + 1) % 3 == 0"></div>
                </div>
                
                <!-- //Точки нужно выводить если они кратны 3 -->
                <button class="slider-button next">
                    <span class="icon-arrow-right"></span>
                </button>
            </div>
        </div>
    </section>
    @endif
    
    
    
    @include('layouts.modules.question')
    <section class="popup popup-delivery" data-target="delivery">
        <button class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.pay_delivery') }}</p>
        <div class="popup-delivery__payment">
            <p class="popup-delivery__caption">
                <span class="icon" style="background-image:url(/img/payment-icon.png)"></span>
                <span class="text">{{ __('text.payment_options') }}</span>
            </p>
            <ul class="delivery__list delivery__list-payment">
	            @foreach($payments as $payment)
                <li class="delivery__item">
                    <div class="delivery__item__img js-img-bg" v-lazy:background-image="'{{ url($payment->image) }}'"></div>
                    <p class="text">{{ $payment->name }}</p>
                </li>
                @endforeach
                <li class="delivery__item">
                    <p class="text">{{ __('text.Another_Payment_Method') }}</p>
                </li>
            </ul>
            <p class="popup-delivery__payment__text">
                {{ __('text.There_are_lots') }}
            </p>
        </div>
        <div class="popup-delivery__option">
            <p class="popup-delivery__caption">
                <span class="icon" style="background-image:url(/img/delivery-icon.png)"></span>
                <span class="text">{{ __('text.we_have_several') }}</span>
            </p>
            <ul class="delivery__list delivery__list-option">
	            @foreach($deliveries->where('type', 'time') as $delivery)
                <li class="delivery__item">
                    <p>{{ $delivery->name }} <span>(from $ {{ $delivery->price }})</span></p>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="popup-delivery__method">
            <p class="popup-delivery__caption">
                <span class="icon" style="background-image:url(/img/delivery-car-icon.png)"></span>
                <span class="text">{{ __('text.We_deliver') }}:</span>
            </p>
            <ul class="delivery__list delivery__list-deliver">
                @foreach($deliveries->where('type', 'method') as $delivery)
                <li class="delivery__item">
                    <p>{{ $delivery->name }}</p>
                </li>
                @endforeach
            </ul>
            <p class="popup-delivery__method__text"></p>{{ __('text.The_Dispatch_takes') }}</p>
        </div>
        <div class="popup-delivery__anonymous">
            <p class="popup-delivery__caption">
                <span class="icon" style="background-image:url(/img/delivery-man-icon.png)"></span>
                <span class="text">{{ __('text.Anonymous_delivery') }}</span>
            </p>
            <p class="popup-delivery__anonymous__text">{{ __('text.Concerning_safety') }}</p>
            <p class="popup-delivery__anonymous__text">{{ __('text.So_you_may') }}</p>
        </div>
    </section>
</main>
@endsection
@push('styles')
	<link href="{{ url('/css/csspages/product-page.css') }}" rel="preload" as="style">
@endpush
@push('scripts')
<script>
  var reviews_data = @json($reviews, JSON_INVALID_UTF8_IGNORE);
  var product_data = @json($product, JSON_INVALID_UTF8_IGNORE);
  var related_data = @json($related, JSON_INVALID_UTF8_IGNORE);
  var recently_data = @json($recently, JSON_INVALID_UTF8_IGNORE);
  var user_data = @json($user);
</script>
<script src="{{ url('js/catalog/product.js') }}"></script>
<script src="{{ url('js/jspages/native/product-page.js') }}"></script>
<script>
        // Product tabs 
    
    let productTabs = document.querySelectorAll('.js-product-tab');
    function generalTabs(){
        if(window.innerWidth < 1024) {
        
            if(document.querySelector('.js-product-item[data-target = reviews]')) {
                document.querySelector('.js-product-item[data-target = reviews]').classList.add('disabled');
            }
            productTabs.forEach((item) => {
                let value = item.getAttribute('data-target');
                let items = document.querySelectorAll('.js-product-item');
                if(!document.querySelector(`.js-product-item[data-target = ${value}]`)) {
                    item.classList.add('disabled');
                }
                
                item.addEventListener('click', function(){
                    items.forEach((item) => {
                        item.classList.add('disabled');
                    });
                    
                    productTabs.forEach((item) => {
                        item.classList.remove('active');
                    });
                    
                    document.querySelector(`.js-product-item[data-target = ${value}]`).classList.remove("disabled");
                    item.classList.add('active');
                });
            });
        }
    }
    generalTabs();
    window.addEventListener('resize', function() {
        if(!window.innerWidth < 1024) {
            if(document.querySelector('.js-product-item[data-target = reviews]')) {
                document.querySelector('.js-product-item[data-target = reviews]').classList.remove('disabled');
                document.querySelector('.general-tabs__item[data-target = reviews]').classList.remove('active');
            }
            
            document.querySelector('.js-product-item[data-target = description]').classList.remove('disabled');
            
            document.querySelector('.general-tabs__item[data-target = description]').classList.add('active');
        }
        
        generalTabs();
    })
    
    // //Product tabs 
</script>
@endpush