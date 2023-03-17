@php
	$current_language = '';
@endphp
<footer class="footer">
    <div class="footer__wrapper container">
        <div class="footer__wrapper__top">
            <div class="footer__logo-wrapper">
                <div class="footer__logo">
                    <img src="{{ '/img/logo.svg' }}" alt="Kratom">
                </div>
            </div>
            <ul class="footer__list">
                @foreach($menu as $item)
                <li class="footer__item">
                    <a href="{{ url_locale($item->link) }}" class="footer__link">{{ $item->name }}</a>
                </li>
                @endforeach
                @foreach($sub_menu as $item)
                <li class="footer__item">
                    <a href="{{ url_locale($item->link) }}" class="footer__link">{{ $item->name }}</a>
                </li>
                @endforeach
            </ul>
            <ul class="footer__social-list">
                <li class="footer__social-item">
                    <a href="{{ config('settings.fb') }}" class="footer__social__link" target="_blank">
                        <span class="icon-fb"></span>
                    </a>
                </li>
                <li class="footer__social-item">
                    <a href="{{ config('settings.inst') }}" class="footer__social__link" target="_blank">
                        <span class="icon-inst"></span>
                    </a>
                </li>
            </ul>
            <div class="footer__lang js-drop-item">
	            <div class="footer__lang_popup">
		            @include('includes.languages')
	            </div>
	            <div class="footer__lang_link js-drop-button">
		            <div><span class="icon-globe"></span></div>
		            <div class="footer__lang_name">
			            {{ $current_language }}
			        </div>
		            <div><span class="icon-drop"></span></div>
	            </div>
            </div>
        </div>
        <div class="footer__wrapper__down">
            <p class="footer__copyright">Copyright © {{ now()->format('Y') }}</p>
            <a href="{{ url_locale('terms') }}" itemprop="url" class="footer__down-link">{{ __('text.Terms_Conditions') }}</a>
            <a href="{{ url_locale('privacy') }}" itemprop="url" class="footer__down-link">{{ __('text.Privacy_Policy') }}</a>
        </div>
        </div>
    </footer>