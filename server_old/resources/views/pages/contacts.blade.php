@php
	$page = \Backpack\PageManager\app\Models\Page::find(10)->withFakes();
@endphp
@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => $page->title]))
@endif

@section('content')

<main>
    {{ Breadcrumbs::render('page', $page->title) }}
    <section class="contact">
        <div class="general-decor-text">kratom helper</div>
        <div class="contact__wrapper container">
            <div class="general-decor-figure"></div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <div class="contact__text">
                <span class="general-decor-elem"></span>
                {!! $page->content !!}
            </div>
            <div class="row cont-data" itemscope="" itemtype="http://schema.org/Organization">
                <meta itemprop="name" content="kratomhelper">
                <meta itemprop="url" content="kratomhelper.com">
                <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                    <meta itemprop="postalCode" content="14000">
                    <meta itemprop="streetAddress" content="Na Hřebenech II 1718/8">
                    <meta itemprop="addressLocality" content="Praha">
                    <meta itemprop="addressCountry" content="Czech Republic">
                </div>
                <meta itemprop="telephone" content="+420 728 591 865">
                <meta itemprop="email" content="info@kratomhelper.com">
            </div>
            <div class="contact__container">
                <div class="contact-to-us">
                    <p class="contact-caption">{{ __('text.contact_to_us') }}</p>
                    <ul class="contact-to-us__list">
                        <li class="contact-to-us__item contact-to-us__item-place">
                            <span class="icon-place"></span>
                            <p>{{ config('settings.address') }}</p>
                        </li>
                        <li class="contact-to-us__item contact-to-us__item-email">
                            <span class="icon-message"></span>
                            <a href="mailto: {{ config('settings.contact_email') }}" class="contact-to-us__link">{{ config('settings.contact_email') }}</a>
                        </li>
                        <li class="contact-to-us__item contact-to-us__item-phone">
                            <span class="icon-phone"></span>
                            <a href="tel:{{ config('settings.tel') }}" class="contact-to-us__link">{{ config('settings.tel') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="wrapper">
                    <div class="contact__write-us">
                        <p class="contact-caption">{{ __('text.write_to_us') }}</p>
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
                                <a href="viber://chat?number={{ config('settings.viber') }}" class="question-block__link">
                                    <span class="icon-viber"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="contact__follow-us">
                        <p class="contact-caption">{{ __('text.follow_us') }}</p>
                        <ul class="question-block__list">
                            <li class="question-block__item question-block__item-fb">
                                <a href="{{ config('settings.fb') }}" target="_blank" class="question-block__link">
                                    <span class="icon-fb"></span>
                                </a>
                            </li>
                            <li class="question-block__item question-block__item-inst">
                                <a href="{{ config('settings.inst') }}" target="_blank" class="question-block__link">
                                    <span class="icon-inst"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if($page->seo_text)
    <section class="seo-block seo-block-main">
	    <div class="seo-block__wrapper container">
		    <div class="seo-block__container">
                {!! $page->seo_text !!}
            </div>
		</div>
    </section>
    @endif
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/contact.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
@endpush

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush