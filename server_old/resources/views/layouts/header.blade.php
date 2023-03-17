@php
	$current_language = '';
	$phone = \App\Models\Setting::get('phone');
@endphp
<header class="header">
    <a href="{{ url_locale('/') }}" class="header__logo">
        <img src="{{ url('/img/logo.png') }}" alt="Kratom">
    </a>
    <nav class="header__nav">
        <span class="general-decor-elem"></span>
        <ul class="header__list">
            @foreach($menu as $item)
            <li class="header__item">
                <a href="{{ url_locale($item->link) }}" class="header__link @if(Request::url() == url($item->link)) active @endif">{{ $item->name }}</a>
            </li>
            @endforeach
            <li class="header__item header__item__drop js-drop-item">
                <div class="wrapper js-drop-button">
                    <a class="text">{{ __('text.menu') }}</a>
                    <span class="icon-drop"></span>
                </div>
                <ul class="header__drop-list">
                    @foreach($sub_menu as $item)
                    <li class="header__drop-item">
                        <a href="{{ url_locale($item->link) }}" class="header__drop-link @if(Request::url() == url($item->link)) active @endif">{{ $item->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <button class="header__close-nav">
            <span class="icon-close"></span>
        </button>
    </nav>
    <div class="header__nav-profile">
        <div class="header__search js-drop-item">
            <div class="header__search-form">
                <input type="text" class="header__search__input" placeholder="{{ __('text.search') }}" autocomplete="off" v-model="search_filter" @blur="search_filter = null">
                <button class="header__search__button">
                    <span class="icon-search"></span>
                </button>
            </div>
            <div class="header__livesearch" v-bind:class="{active: search_list.length}">
                <ul class="header__livesearch-list">
                    <li class="header__livesearch-item" v-for="item in search_list">
                        <a :href="item.link" :title="item.name" class="header__livesearch-link">@{{ item.name }}</a>
                    </li>
                </ul>
            </div>
            <button class="header__search__button js-drop-button">
                <span class="icon-search"></span>
            </button>
        </div>
        <div class="header__nav-lang__item js-drop-item">
	        <div class="footer__lang_popup">
	           @include('includes.languages')
            </div>
	        
	        <button class="js-button js-drop-button">
                <span class="icon-globe"></span>
            </button>
        </div>
        <div class="header__nav-profile__item">
            @if(!$user)
            <button class="js-button" data-target="registration-social">
                <span class="icon-profile"></span>
            </button>
            @else
            <a href="{{ url_locale('account/order-history')}}">
                @if($user->usermeta && $user->usermeta->photo)
                	<div class="img" style="background-image:url({{ url($user->usermeta->photo) }})"></div>
                @else
                	<div class="img" style="background-image:url({{ url('/img/photo-log-in.png') }})"></div>
                @endif
            </a>
            @endif
        </div>
        <div class="header__nav-profile__item header__nav-profile__item-cart">
            <button class="js-button" data-target="noty-cart">
                <span class="icon-cart"></span>
            </button>
            <span class="decor-cart" v-if="cartLength"></span>
        </div>
        <div class="header__nav-profile__item header__nav-profile__item-burger">
            <button class="header__burger">
                <span class="decor"></span>
            </button>
        </div>
    </div>
</header>
<section class="popup popup-noty-cart" data-target="noty-cart">
    <div class="popup-noty-cart__header">
        <button class="general-more js-close">
            <span class="icon-arrow-left"></span>
            <span class="text">{{ __('text.Back') }}</span>
        </button>
        <p class="main-caption">{{ __('text.cart') }}</p>
    </div>
    <template v-if="cartLength">
        <div class="popup-noty-cart__body">
            <ul class="popup-noty-cart__list">
                <template v-for="(product, key) in cart">
                    <template v-for="modification in product">
                        <li class="popup-noty-cart__item">
                            <a :href="modification.product_link" class="popup-noty-cart__img">
                                <img :src="modification.product_image" :alt="modification.product_name" :title="modification.product_name">
                            </a>
                            <div class="popup-noty-cart__info">
                                <p class="name"> 
                                    <a :href="modification.product_link">@{{ modification.product_name }}</a>
                                </p>
                                <p class="info">
                                    <span class="weight">@{{ modification.name }}</span>
                                    <span>x</span>
                                    <span class="calc">@{{ modification.amount }}</span>
                                </p>
                                <div class="info__footer">
                                    <p class="price"> USD <span>@{{ modification.price }}</span></p>
                                    <button class="delete-button" @click="deleteFromCart(key, modification.id)">
                                        <span class="icon-delete"></span>
                                    </button>
                                </div>
                            </div>
                        </li>
                </template>
            </template>
            </ul>
        </div>
        <div class="popup-noty-cart__footer js-drop-item">
            <button class="popup-noty-cart__open-button js-drop-button"></button>
            <div class="total__wrapper ">
                <div class="total__item total__item-general">
                    <p class="type">{{ __('text.subtotal') }}</p>
                    <p class="description">usd @{{ total }}</p>
                </div>
            </div>
            <a href="{{ url_locale('checkout') }}" @click="checkIfCartEmpty($event)" class="main-button-color popup-noty-cart__button">
                <span class="text">{{ __('text.checkout') }}</span>
            </a>
            <a href="{{ url_locale('shop') }}" class="main-button popup-noty-cart__button">
                <span class="text">{{ __('text.edit') }}</span>
            </a>
        </div>
    </template>
    <p class="popup-noty__empty" v-else>{{ __('text.cart_is_empty') }}</p>
</section>
<section class="push_notification">
    <ul class="push_notification__list">
    </ul>
</section>