<template>
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
</template>