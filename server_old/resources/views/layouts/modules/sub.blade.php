<section class="subscribe js-img-bg" v-lazy:background-image="'{{url('/img/question-block-img.png')}}'">
    <div class="subscribe__wrapper container">
        <div class="subscribe__container">
            <p class="main-caption">{{ __('text.Want_to_receive') }}</p>
            <p class="sub">{{ __('text.Subscribe_to_newsletter') }}</p>
            <form action="#" class="subscribe__form">
                <label class="input__wrapper js-input-wrapper">
                    <input type="email" class="main-input js-input">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">Email <span>*</span></span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <button class="main-button-color">
                    <span class="text">{{ __('text.subscribe') }}</span>
                </button>
            </form>
        </div>
    </div>
</section>