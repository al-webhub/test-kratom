@php
    $inputs = session()->get('inputs');
@endphp
@extends('layouts.app')
@section('content')
<main>
    {{ Breadcrumbs::render('checkout') }}
    <form action="{{ url('/order/create') }}" method="post" class="checkout" @submit="checkForm">
    @csrf
    <input type="hidden" name="usermeta_id" value="{{ $user? $user->usermeta->id : '' }}">
    <input type="hidden" name="referrer_id">
        <section class="cart">
            <div class="cart__wrapper container">
                <div class="general-decor-figure"></div>
                <p class="main-caption main-caption-align" v-if="!hideCartHeader">{{ __('text.cart') }}</p>
                <p class="main-caption-l">{{ __('text.your_order') }}</p>
                <div class="order__wrapper" v-if="!hideCartHeader">
                    <div class="order__info">
                        <p class="main-caption-l">{{ __('text.your_order') }}</p>
                        <div class="order__info__header">
                            <p class="order__info__name order-position-item">{{ __('text.item') }}</p>
                            <p class="order__info__name order-position-price">{{ __('text.price') }}</p>
                            <p class="order__info__name order-position-quantity">{{ __('text.quantity') }}</p>
                            <p class="order__info__name order-position-subtotal">{{ __('text.subtotal') }}</p>
                            <p class="order__info__name order-position-last"></p>
                        </div>
                        <ul class="order__info__list">
                            <template v-for="(product, key) in cart">
                                <template v-for="modification in product">
                                    <li class="order__info__item">
                                        <div class="order__info__preview order-position-item">
                                            <div class="order__info__preview__img">
                                                <a :href="modification.product_link">
                                                    <img :src="modification.product_image" :alt="modification.product_name" :title="modification.product_name">
                                                </a>
                                            </div>
                                            <div class="order__info__preview__descrip">
                                                <p class="order__info__preview__name">
                                                    <a :href="modification.product_link">@{{ modification.product_name }}</a>
                                                </p>
                                                <ul class="product__weight-list">
                                                    <li class="product__weight-item">@{{ modification.name }}</li>
                                                </ul>
                                                <div class="order-tablet-version">
                                                    <div class="order__info__price">
                                                        <p>USD <span>@{{ modification.price }}</span></p>
                                                    </div>
                                                    <div class="order__info__quantity">
                                                        <p class="order-caption">{{ __('text.quantity') }}:</p>
                                                        <div class="product__calc">
                                                            <button type="button" class="calc_button" @click="modification.amount > 1 ? modification.amount-- : false">
                                                                <span class="text">-</span>
                                                            </button>
                                                            <input type="text" class="calc-input" v-model="modification.amount">
                                                            <button type="button" class="calc_button" @click="modification.amount++">
                                                                <span class="text">+</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order__info__price order-position-price">
                                            <p>USD <span>@{{ modification.price }}</span></p>
                                        </div>
                                        <div class="order__mobile-weight">
                                            <ul class="product__weight-list">
                                                <li class="product__weight-item">@{{ modification.name }}</li>
                                            </ul>
                                        </div>
                                        <div class="order__info__quantity order-position-quantity">
                                            <p class="order-caption">{{ __('text.quantity') }}:</p>
                                            <div class="product__calc">
                                                <button type="button" class="calc_button" @click="modification.amount > 1 ? modification.amount-- : false">
                                                    <span class="text">-</span>
                                                </button>
                                                <input type="text" class="calc-input" v-model="modification.amount">
                                                <button type="button" class="calc_button" @click="modification.amount++">
                                                    <span class="text">+</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="order__info__price order__info__price-subtotal order-position-subtotal">
                                            <p class="order-caption">{{ __('text.subtotal') }}:</p>
                                            <p>USD <span>@{{ modification.price * modification.amount }}</span></p>
                                        </div>
                                        <div class="order-position-last order__delete">
                                            <button type="button" class="delete-button" @click="deleteFromCart(key, modification.id)" title="Remove">
                                                <span class="icon-delete"></span>
                                            </button>
                                        </div>
                                    </li>
                                </template>
                            </template>
                            <li v-if="!cartLength" style="margin-top: 30px;">{{ __('text.cart_is_empty') }}</li>
                        </ul>
                    </div>
                    <div class="order__info-bar">
                        <div class="order__info-bar__wrapper">
                            <p class="caption">{{ __('text.your_order') }}</p>
                            <div class="total__wrapper">
                                <div class="total__item">
                                    <p class="type">{{ __('text.order_price') }}</p>
                                    <p class="description">usd @{{ total }}</p>
                                </div>
                                @if($user)
                                <div class="bonuses__container">
                                    <div class="bonuses__wrapper">
                                        <p>how much do you <br> want to use?</p>
                                    </div>
                                    <div class="bonuses__wrapper">
                                        <p class="sub-text">{{ __('text.your_bonus_balance') }}: <span>USD @{{ bonusesLeft }}</span></p>
                                        <div class="product__calc">
                                            <button type="button" class="calc_button" @click="bonusesUsedChange(-1)">
                                                <span class="text">-</span>
                                            </button>
                                            <input type="number" name="bonuses_used" size="1" class="calc-input" min="0" step="0.01" :max="maxBonusesUsed()" v-model="bonusesUsed" @keydown="bonusesUsed > maxBonusesUsed()? bonusesUsed = maxBonusesUsed() : true" @keyup="bonusesUsed > maxBonusesUsed()? bonusesUsed = maxBonusesUsed() : true">
                                            <button type="button" class="calc_button" @click="bonusesUsedChange(1)">
                                                <span class="text">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="total-info js-drop-item">
                                    <p class="total-info__caption">+{{ __('text.delivery_cost') }}</p>
                                    <button type="button" class="info-button js-drop-button"></button>
                                    <div class="info-drop"><p>{{ __('text.The_Dispatch_takes') }}</p></div>
                                </div>
                                <div class="total__item total__item-general">
                                    <p class="type">{{ __('text.subtotal') }}</p>
                                    <p class="description">usd @{{ total - bonusesUsed }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="order__info-bar__text">
                            <a href="{{ url('/contacts') }}">{{ __('text.Сontact_us') }}</a> 
                            <span>{{ __('text.have_questions') }}</span>
                        </p>
                    </div>
                    <button v-if="cartLength" @click="hideCartHeader = true; innerWidth = false; destroyedResize();" class="main-button-color main-button-color-mobile">
                        <span class="text">{{ __('text.checkout') }}</span>
                    </button>
                </div>
                
                
                <!-- CHECKOUT -->
                <div v-if="cartLength" class="checkout__wrapper checkout__wrapper-cart" v-bind:class="{disabled: innerWidth}">
                    
                    <p class="main-caption-l">{{ __('text.checkout') }}</p>
                    <ul class="checkout__list">
                        
                        <li class="checkout__item active">
                            <div class="checkout__item__noty">
                                <p>{{ __('text.Please_complete') }}</p>
                            </div>
                            <div class="checkout__item__header">
                                <p class="calc">1/3</p>
                                <p class="caption">{{ __('text.information') }}</p>
                            </div>
                            <div class="checkout__item__body">
                                <p class="checkout-caption checkout-caption-information">{{ __('text.Register_for_quicker') }}</p>
                                <p class="text">{{ __('text.All_registered_users') }}</p>
                            </div>
                            <ul class="general-tabs__list">
                                <li class="general-tabs__item" :class="{active: currentTab == 'guest'}" @click="currentTab = 'guest'" v-if="!user">{{ __('text.Checkout_as_guest') }}</li>
                                <li class="general-tabs__item" :class="{active: currentTab == 'login'}" @click="currentTab = 'login'">{{ __('text.Log_In') }}</li>
                                <li class="general-tabs__item" :class="{active: currentTab == 'register'}" @click="currentTab = 'register'" v-if="!user">{{ __('text.Register_account') }}</li>
                            </ul>
                            <div class="checkout_form__wrapper" v-if="currentTab == 'guest'">
                                <label class="input__wrapper js-input-wrapper @error('firstname') error @enderror" >
                                    <input type="text" class="main-input js-input" required name="firstname" value="{{ $inputs['firstname'] ?? '' }}" v-model="new_user.firstname">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.First_name') }}<span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    @error('firstname')
                                        <span class="input-error-text">{{ $message }}</span>
                                    @enderror  
                                </label>
                                <label class="input__wrapper js-input-wrapper">
                                    <input type="text" class="main-input js-input" value="{{ $inputs['lastname'] ?? '' }}" name="lastname" v-model="new_user.lastname">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.Last_name') }}</span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                </label>
                                <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                                    <input type="text" class="main-input js-input js-drop-input js-drop-button" required name="extras[communication]" readonly  v-model="selectedCommunication"> 
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.Preferred_communication') }}<span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    <span class="icon-drop"></span>
                                    <div class="general-drop__list">
                                        <div class="general-drop__item general-drop__item-select">
                                            <div class="text">{{ __('text.Please_select') }}</div>
                                        </div>
                                        <div class="general-drop__item js-drop-contains" v-for="(communication, index) in communications" @click="selectedCommunication = communication">
                                            <span class="icon-active"></span>
                                            <div class="text">@{{ communication }}</div>
                                        </div>
                                    </div>
                                </div>
                                <label class="input__wrapper js-input-wrapper" :class="{disabled: !selectedCommunication}">
                                    <input type="text" class="main-input js-input" required name="extras[communication_number]" value="{{ $inputs['extras']['communication_number'] ?? '' }}" v-model="new_user.communication_number">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">@{{ selectedCommunication }} {{ __('text.account') }}<span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                </label>
                                <div class="chckout__item__shipping-info" style="margin-top:0">
	                                <p>{{ __('text.your_telephone_number') }}</p>
	                            </div>
                            </div>
                            
                            <!-- Log in  -->
                            
                            <div class="checkout_form__wrapper" v-else-if="currentTab == 'login'">
                                @if($user)
                                <div class="checkout-user">
                                    <div class="checkout-user__container">
                                        <div class="checkout-user__img" style="background-image:url(./img/photo-log-in.png)"></div>
                                        <p class="checkout-user__name">{{ $user->usermeta->firstname }}</p>
                                        <p class="checkout-user__active"><span class="icon-active"></span></p>
                                    </div>
                                    <button type="button" class="checkout-user__logout js-button" data-target="logout">
                                        <span class="text">{{ __('text.logout') }}</span>
                                    </button>
                                </div>
                                @else
                                <label class="input__wrapper js-input-wrapper @error('email') error @enderror">
                                    <input type="email" class="main-input js-input" required value="{{ $inputs['email'] ?? '' }}" v-model="login">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">Email</span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    @error('email')
                                        <span class="input-error-text">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="input__wrapper js-input-wrapper @error('password') error @enderror">
                                    <input type="password" class="main-input js-input" v-model="password">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.Password') }}</span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                        @error('password')
                                            <span class="input-error-text">{{ $message }}</span>
                                        @enderror
                                    </span>
                                    <button type="button" class="show-password">
                                        <span class="icon-show-pass"></span>
                                    </button>
                                </label>
                                <button type="button" class="button-nav js-button" data-target="change-pass">{{ __('text.Forgot_Password') }}</button>
                                <button type="button" class="main-button-color" onclick="document.querySelector('.hidden-login-form').submit()">
                                    <span class="text">{{ __('text.Log_In') }}</span>
                                </button>
                                @endif
                            </div>
                            
                            
                            <!-- //Log in  -->
                            
                            <!-- Registr  -->
                            
                            <div class="checkout_form__wrapper" v-else-if="currentTab == 'register'">
                                <label class="input__wrapper js-input-wrapper @error('name') error @enderror">
                                    <input type="text" class="main-input js-input" name="name" value="{{ old('name') }}" require>
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.First_name') }}<span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    @error('name')
                                        <span class="input-error-text">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="input__wrapper js-input-wrapper @error('lastname') error @enderror">
                                    <input type="text" class="main-input js-input" value="{{ old('lastname') }}">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.Last_name') }}</span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    @error('lastname')
                                        <span class="input-error-text">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="input__wrapper js-input-wrapper @error('email') error @enderror">
                                    <input type="email" class="main-input js-input" value="{{ old('email') }}">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">Email <span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    @error('email')
                                        <span class="input-error-text">{{ $message }}</span>
                                    @enderror
                                </label>
                                <!-- Добавил пароль, в макете его небыло -->
                                <label class="input__wrapper js-input-wrapper @error('password') error @enderror">
                                    <input type="password" name="password" class="main-input js-input">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.Password') }} <span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    @error('password')
                                        <span class="input-error-text">{{ $message }}</span>
                                    @enderror
                                </label>
                                <!-- //Добавил пароль, в макете его небыло -->
                                <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                                    <input type="text" name="extras[communication]" class="main-input js-input js-drop-input js-drop-button" readonly require> 
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">{{ __('text.Preferred_communication') }}<span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                    <span class="icon-drop"></span>
                                    <div class="general-drop__list">
                                        <div class="general-drop__item general-drop__item-select">
                                            <div class="text">{{ __('text.Please_select') }}</div>
                                        </div>
                                        <div class="general-drop__item js-drop-contains" v-for="(communication, index) in communications" @click="selectedCommunication = communication">
                                            <span class="icon-active"></span>
                                            <div class="text">@{{ communication }}</div>
                                        </div>
                                    </div>
                                </div>
                                <label class="input__wrapper js-input-wrapper">
                                    <input type="text" class="main-input js-input">
                                    <span class="custome-placeholder__wrapper">
                                        <span class="custome-placeholder__before"></span>
                                        <span class="custome-placeholder__text">
                                            <span class="inner-text">@{{ selectedCommunication }} {{ __('text.account') }}<span>*</span></span>
                                        </span>
                                        <span class="custome-placeholder__after"></span>
                                    </span>
                                </label>
                                <button class="main-button-color">
                                    <span class="text">{{ __('text.sign_up') }}</span>
                                </button>
                                <div class="popup__footer">
                                    <div class="popup__footer__sing-up">
                                        <p>{{ __('text.Already_have_account') }}</p>
                                        <button type="button" class="button-enter js-button" data-target="log-in">{{ __('text.Log_In') }}</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="checkout__item" :class="{active:isShippingTabActive}">
                            <div class="checkout__item__noty">
                                <p>{{ __('text.Please_complete') }}</p>
                            </div>
                            <div class="checkout__item__header">
                                <p class="calc">2/3</p>
                                <p class="caption">{{ __('text.shipping') }}</p>
                            </div>
                            <div class="checkout__item__body">
                                <p class="checkout-caption">{{ __('text.desired_delivery') }}</p>
                                <ul class="delivery__list delivery__list-option delivery__list-option-checkout">
                                    <li class="delivery__item" v-for="method in deliveries">
                                        <label class="input__wrapper input__wrapper-radio">
                                            <input type="radio" class="input-radio" name="delivery" v-model="selectedDelivery" :value="method.name">
                                            <span class="custome-radio"></span>
                                            <p>@{{ method.name }} <br> <span>({{ __('text.from') }} $@{{ method.price }})</span></p>
                                        </label>
                                    </li>
                                </ul>
                                <p class="checkout-caption">{{ __('text.Shipping_address') }}</p>
                                <div class="checkout__item__address">
                                    <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                                        <input type="text" class="main-input js-input js-drop-input js-drop-button" name="address_details[country]" value="{{ $user? $user->usermeta->addressDetails['country']: 'Please select' }}" readonly required v-model="address.country"> 
                                        <span class="custome-placeholder__wrapper">
                                            <span class="custome-placeholder__before"></span>
                                            <span class="custome-placeholder__text">
                                                <span class="inner-text">{{ __('text.Country_Region') }}<span>*</span></span>
                                            </span>
                                            <span class="custome-placeholder__after"></span>
                                        </span>
                                        <span class="icon-drop"></span>
                                        <div class="general-drop__list">
                                            <div class="general-drop__item general-drop__item-select">
                                                <div class="text">{{ __('text.Please_select') }}</div>
                                            </div>
                                            <div class="general-drop__item js-drop-contains" :class="{active: isUserCountry}" v-for="(country, index) in countries" @click="address.country = country">
                                                <span class="icon-active"></span>
                                                <div class="text">@{{ country }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="input__wrapper js-input-wrapper">
                                        <input type="text" class="main-input js-input" name="address_details[city]" value="{{ $user? $user->usermeta->addressDetails['city']: '' }}" required v-model="address.city">
                                        <span class="custome-placeholder__wrapper">
                                            <span class="custome-placeholder__before"></span>
                                            <span class="custome-placeholder__text">
                                                <span class="inner-text">{{ __('text.Town_City') }}<span>*</span></span>
                                            </span>
                                            <span class="custome-placeholder__after"></span>
                                        </span>
                                    </label>
                                    <!-- update -->
                                    <label class="input__wrapper js-input-wrapper">
                                        <input type="text" class="main-input js-input" name="address_details[state]" value="{{ $user? $user->usermeta->addressDetails['state']: '' }}" v-model="address.state">
                                        <span class="custome-placeholder__wrapper">
                                            <span class="custome-placeholder__before"></span>
                                            <span class="custome-placeholder__text">
                                                <span class="inner-text">{{ __('text.State') }}</span>
                                            </span>
                                            <span class="custome-placeholder__after"></span>
                                        </span>
                                    </label>
                                    <label class="input__wrapper js-input-wrapper">
                                        <input type="text" class="main-input js-input" name="address_details[street]" v-model="address.street">
                                        <span class="custome-placeholder__wrapper">
                                            <span class="custome-placeholder__before"></span>
                                            <span class="custome-placeholder__text">
                                                <span class="inner-text">{{ __('text.Street_Number') }}</span>
                                            </span>
                                            <span class="custome-placeholder__after"></span>
                                        </span>
                                    </label>
                                    <!-- /update -->
                                    <label class="input__wrapper js-input-wrapper">
                                        <input type="text" class="main-input js-input" name="address_details[apartment]" value="{{ $user? $user->usermeta->addressDetails['apartment']: '' }}" v-model="address.apartment">
                                        <span class="custome-placeholder__wrapper">
                                            <span class="custome-placeholder__before"></span>
                                            <span class="custome-placeholder__text">
                                                <span class="inner-text">{{ __('text.Apartment_house_flat') }}</span>
                                            </span>
                                            <span class="custome-placeholder__after"></span>
                                        </span>
                                    </label>
                                    <label class="input__wrapper js-input-wrapper">
                                        <input type="text" class="main-input js-input" name="address_details[zip]" value="{{ $user? $user->usermeta->addressDetails['zip']: '' }}" v-model="address.zip">
                                        <span class="custome-placeholder__wrapper">
                                            <span class="custome-placeholder__before"></span>
                                            <span class="custome-placeholder__text">
                                                <span class="inner-text">{{ __('text.ZIP') }}</span>
                                            </span>
                                            <span class="custome-placeholder__after"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="chckout__item__shipping-info">
                                    <p class="caption">{{ __('text.We_deliver') }}:</p>
                                    <ul class="delivery__list delivery__list-deliver">
                                        @foreach($deliveries->where('type', 'method') as $delivery)
				                        <li class="delivery__item">
				                            <p>{{ $delivery->name }}</p>
				                        </li>
				                        @endforeach
                                    </ul>
                                    <!-- update -->
                                    <p>{{ __('text.The_Dispatch_takes') }}</p>
                                    <!-- /update -->
                                    <div class="checkout__item__anonympus">
                                        <p class="checkout-caption">{{ __('text.Anonymous_delivery') }}</p>
                                        <p>{{ __('text.Concerning_safety') }}</p>
                                        <p>{{ __('text.So_you_may') }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="checkout__item" :class="{active:isPaymentTabActive}">
                            <div class="checkout__item__header">
                                <p class="calc">3/3</p>
                                <p class="caption">{{ __('text.payment') }}</p>
                            </div>
                            <div class="checkout__item__body">
                                <ul class="delivery__list delivery__list-payment delivery__list-payment-checkout">
                                    <li class="delivery__item" v-for="method in payments">
                                        <label class="input__wrapper input__wrapper-radio">
                                            <input type="radio" class="input-radio" name="payment" v-model="selectedPayment" :value="method.name">
                                            <span class="custome-radio"></span>
                                            <div class="delivery__item__img" :style="{backgroundImage: 'url(' + method.image + ')'}"></div>
                                            <p class="text">@{{ method.name }}</p>
                                        </label>
                                    </li>
                                    <li class="delivery__item" @click="selectedPayment = 'another'">
                                        <label class="input__wrapper input__wrapper-radio">
                                            <input type="radio" class="input-radio" name="delivery-pay">
                                            <span class="custome-radio"></span>
                                            <p class="text">{{ __('text.Another_Payment_Method') }}</p>
                                        </label>
                                    </li>
                                </ul>
                                @if($user)
                                <div class="check-bonuse">
                                    <p class="type">{{ __('text.Bonuses_used') }}</p>
                                    <p class="description">USD @{{ bonusesUsed }}</p>
                                </div>
                                <button class="check-bonuse__button js-button" data-target="bonuses">{{ __('text.change_bonus_amount') }}</button>
                                @endif
                            </div>
                            <div class="checkout__item__footer">
                                <div class="checkout__item__policy">
                                    <label class="input__wrapper input__wrapper-checkbox">
                                        <input type="checkbox" class="input-checkbox" v-model="privatePolicy" value="1" required>
                                        <span class="custome-checkbox">
                                            <span class="icon-active"></span>
                                        </span>
                                        <p class="privat-policy-text">{{ __('text.I_agreed_with') }} <a href="{{ url('/privacy') }}">{{ __('text.Privacy_Policy') }}</a></p>
                                    </label>
                                </div>
                                <button class="main-button-color" :class="{disabled:!canConfirm}">
                                    <span class="text">{{ __('text.confirm_order') }}</span>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </form>
    <form method="POST" action="{{ route('login') }}" class="hidden-login-form">
        @csrf
        <input type="hidden" name="checkout" value="1">
        <input type="hidden" name="email" value="{{ old('email') }}" v-model="login">
        <input type="hidden" name="password" v-model="password">
    </form>
    @include('layouts.modules.question')
    
    <!-- Попап для модилы, чтобы удалить товар -->
    
    <section class="popup popup-delete-cart-item" data-target="delete-cart-item">
        <button class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.delete_this_item') }}</p>
        <button class="main-button-color">
            <span class="text">{{ __('text.yes') }}</span>
        </button>
        <button class="button-only-text">
            <span class="text">{{ __('text.cancel') }}</span>
        </button>
    </section>
    
    <!-- Попап для модилы, чтобы удалить товар -->
    <section class="popup popup-bonuses" data-target="bonuses">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.Bonuses_used') }}</p>
        <div class="popup__body">
            <div class="bonuses__wrapper">
                <p>{{ __('text.your_bonus_balance') }}:</p>
                <p>usd @{{ bonusesLeft }}</p>
            </div>
            <div class="bonuses__wrapper">
                <p>{{ __('text.how_much') }}</p>
                <div class="product__calc">
                    <button type="button" class="calc_button" @click="bonusesUsedChange(-1)">
                        <span class="text">-</span>
                    </button>
                    <input type="number" name="bonuses_used" size="1" class="calc-input" min="0" step="0.01" :max="maxBonusesUsed()" v-model="bonusesUsed" @keydown="bonusesUsed > maxBonusesUsed()? bonusesUsed = maxBonusesUsed() : true" @keyup="bonusesUsed > maxBonusesUsed()? bonusesUsed = maxBonusesUsed() : true">
                    <button type="button" class="calc_button" @click="bonusesUsedChange(1)">
                        <span class="text">+</span>
                    </button>
                </div>
            </div>
            <button type="button" class="main-button-color main-button-color-popup js-close">
                <span class="text">{{ __('text.use') }}</span>
            </button>
            <a href="{{ url('/account/referral-network')}}" type="button" class="main-button main-button-color-popup js-button">
                <span class="text">{{ __('text.financial_information') }}</span>
            </a>
        </div>
    </section>
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/checkout.css') }}" rel="preload" as="style">
@endpush
@push('scripts')
<script>
  document.addEventListener( "DOMContentLoaded", function() {
    document.querySelector('input[name="referrer_id"]').value = localStorage.getItem('kratom_ref_id');
  });
</script>
<script>
  var bonusBalance = @json($bonus_balance);
  var deliveries = @json($deliveries->where('type', 'time'));
  var payments = @json($payments);
  var data_user = @json($user);
  var data_countries = @json(__('countries'));
</script>
<script src="{{ url('js/checkout/checkout.js') }}"></script>
<script src="{{ url('js/jspages/native/checkout.js') }}"></script>
@endpush