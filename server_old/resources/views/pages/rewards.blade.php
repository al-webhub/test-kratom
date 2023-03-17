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
    <section class="earn">
        <div class="earn__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="general-decor-figure"></div>
            <div class="general-decor-text">kratom helper</div>
            <h1 class="main-caption main-caption-align">{{ $page->h1 ?? $page->title }}</h1>
            <div class="earn__compensation">
                <h2 class="main-caption-l">{!! $page->compensation_mt_1 !!}</h2>
                <ul class="earn__compensation__list">
                    <li class="earn__compensation__item">
                        <div class="general-decor-caption">
                            <div class="img orders js-img-bg" v-lazy:background-image="'{{ url('/img/rewards.png')}}'"></div>
                        </div>
                        <h3 class="main-caption-s">{{ $page->compensation_t_1 }}</h3>
                        {!! $page->compensation_c_1 !!}
                        
                    </li>
                    <li class="earn__compensation__item">
                        <div class="general-decor-caption">
                            <div class="img discounts js-img-bg" v-lazy:background-image="'{{ url('/img/rewards.png')}}'"></div>
                        </div>
                        <h3 class="main-caption-s">{{ $page->compensation_t_2 }}</h3>
                        {!! $page->compensation_c_2 !!}
                    </li>
                    <li class="earn__compensation__item">
                        <div class="general-decor-caption">
                            <div class="img money js-img-bg" v-lazy:background-image="'{{ url('/img/rewards.png')}}'"></div>
                        </div>
                        <h3 class="main-caption-s">{!! $page->compensation_t_3 !!}</h3>
                        {!! $page->compensation_c_3 !!}
                    </li>
                </ul>
            </div>
            <div class="earn__partner-programm">
                <h2 class="main-caption-l">{!! $page->program_mt_1 !!}</h2>
                {!! $page->partner_program_info !!}
            </div>
            <div class="earn__how-works">
                <h2 class="main-caption-l">{!! $page->htw_mt_1 !!}</h2>
                <ul class="earn__how-works__list">
                    <li class="earn__how-works__item">
                        <div class="number-wrapper">
                            <p class="number">1.</p>
                        </div>
                        <p class="main-caption-s">{!! $page->program_t_1 !!}</p>
                        {!! $page->program_c_1 !!}
                    </li>
                    <li class="earn__how-works__item">
                        <div class="number-wrapper">
                            <p class="number">2.</p>
                        </div>
                        <p class="main-caption-s">{!! $page->program_t_2 !!}</p>
                        {!! $page->program_c_2 !!}
                    </li>
                    <li class="earn__how-works__item">
                        <div class="number-wrapper">
                            <p class="number">3.</p>
                        </div>
                        <p class="main-caption-s">{!! $page->program_t_3 !!}</p>
                        {!! $page->program_c_3 !!}
                    </li>
                </ul>
            </div>
            <div class="earn__text">
                {!! $page->htw_info !!}
            </div>
        </div>
    </section>
    <section class="subscribe js-img-bg" v-lazy:background-image="'{{url('/img/question-block-img.png')}}'">
        <div class="subscribe__wrapper container">
            <div class="subscribe__container">
                <h2 class="main-caption">{{ __('text.Lets_earn_together') }}</h2>
                <p class="sub">{{ __('text.Bring_your_friends_to_us') }}</p>
                @if($user)
                <a href="{{ route('transactions') }}" class="main-button-color main-button-color-earn">
                    <span class="text">{{ __('text.earn_with_us') }}</span>
                </a>
                @else
                <button class="main-button-color main-button-color-earn js-button" data-target="registration-social">
                    <span class="text">{{ __('text.earn_with_us') }}</span>
                </button>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
	<link href="{{ url('/css/csspages/earn.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
@endpush

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush