<section class="question-block js-img-bg" v-lazy:background-image="'/glide/question-block-img.png?h=304&w=1423&fm=pjpg&q=55'">
    <div class="question-block__wrapper container">
        <div class="question-block__container">
            <p class="main-caption">{{ __('text.have_any_questions?') }}</p>
            <p class="sub">{{ __('text.Write_to_us') }}</p>
            <ul class="question-block__list">
                <li class="question-block__item question-block__item-message">
                    <a href="mailto: {{ config('settings.contact_email') }}" class="question-block__link">
                        <span class="icon-message"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-teleg">
                    <a href="tg://resolve?domain={{ config('settings.tg') }}" class="question-block__link">
                        <span class="icon-teleg"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-whatsapp">
                    <a href="https://wa.me/{{ config('settings.whatsapp') }}" class="question-block__link">
                        <span class="icon-whatsapp"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-skype">
                    <a href="skype:{{ config('settings.skype') }}?chat" class="question-block__link">
                        <span class="icon-skype"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-viber">
                    <a href="viber://pa?chatURI={{ config('settings.viber') }}" class="question-block__link">
                        <span class="icon-viber"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>