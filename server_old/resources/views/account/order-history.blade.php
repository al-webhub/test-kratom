@section('breadcrumbs', Breadcrumbs::render('accountPage', __('text.order_history')))

@extends('account.layouts.app')

@section('account')
<div class="profile__info">
    <p class="profile__info__caption">{{ __('text.order_history') }}</p>
    @if(count($orders))
    <div class="profile__order-history">
        <div class="order-history__header">
            <p class="order-history__name order-history-position-num">№</p>
            <p class="order-history__name order-history-position-date">{{ __('text.Order_date') }}</p>
            <p class="order-history__name order-history-position-recipient">{{ __('text.Recipient') }}</p>
            <p class="order-history__name order-history-position-total">{{ __('text.Total') }}</p>
            <p class="order-history__name order-history-position-status">{{ __('text.Status') }}</p>
            <p class="order-history__name order-history-position-details">{{ __('text.Details') }}</p>
            <p class="order-history-position-button"></p>
        </div>
        @foreach($orders as $order)
        <div class="order-history__container js-drop-item">
            <ul class="order-history__list">
                <li class="order-history__item order-history-position-num">
                    <p class="type">№</p>
                    <p class="description">{{ $order->code }}</p>
                </li>
                <li class="order-history__item order-history-position-date">
                    <p class="type">{{ __('text.Order_date') }}</p>
                    <p class="description">{{ $order->created_at->format('d F Y') }}</p> 
                </li>
                <li class="order-history__item order-history-position-recipient">
                    <p class="type">{{ __('text.Recipient') }}</p>
                    <p class="description">{{ $order->info['payment'] ?? '–' }}</p> 
                </li>
                <li class="order-history__item order-history-position-total">
                    <p class="type">{{ __('text.Total') }}</p>
                    <p class="description">USD $ {{ $order->price }}</p> 
                </li>
                <li class="order-history__item order-history__status order-history-position-status">
                    <p class="type">{{ __('text.Status') }}</p>
                    <p class="description">
                        {!! $order->statusString !!}
                    </p>
                </li>
                <li class="order-history__item order-history__button order-history-position-details">
                    <p class="type">{{ __('text.Details') }}</p>
                    <button class="button-details js-drop-button">
                        <span class="icon-drop"></span>
                    </button>
                </li>
                <li class="order-history__item order-history__item-general-button order-history-position-button">
                    <a href="{{ url('/order/'.$order->id.'/clone') }}" class="main-button main-button-small main-button-confirm">
                        <span class="text">{{ __('text.repeat_order') }}</span>
                    </a>
                    <button class="button-details js-drop-button button-details-mobile">
                        <span class="icon-drop"></span>
                    </button>
                </li>
            </ul>
            <div class="order-details">
                <div class="order-details__order order-details__item">
                    <p class="order-details__caption">{{ __('text.your_order') }}</p>
                    <ul class="order-details__list">
                        @foreach($order->info['products'] as $product)
	                        @foreach($product as $modification)
	                        <li class="order-details__order__item">
	                            <div class="order-details__preview">
	                                <div class="order-details__preview__img">
	                                    <a href="{{ $modification['product_link'] }}">
	                                        <img src="{{ $modification['product_image'] }}" >
	                                    </a>
	                                </div>
	                                <div class="order-details__preview__descrip">
	                                    <p class="order-details__preview__name">
	                                        <a href="{{ $modification['product_link'] }}" >{{ $modification['product_name'] }}</a>
	                                    </p>
	                                    <div class="wrapper">
	                                        <p class="order-details__preview__weight">
	                                            {{ $modification['name'] }} <span>x</span>{{ $modification['amount'] }}
	                                        </p>
	                                        <p class="order-details__preview__price">
	                                            USD {{ $modification['price'] * $modification['amount'] }}
	                                        </p>
	                                    </div>
	                                </div>
	                            </div>
	                        </li>
	                        @endforeach
                        @endforeach
                    </ul>
                </div>
                <div class="order-details__shipping order-details__item">
                    <p class="order-details__caption">{{ __('text.Shipping_address') }}</p>
                    <p class="text">{{ implode(', ', $order->info['address_details']) }}</p>
                </div>
                <div class="order-details__delivery order-details__item">
                    <p class="order-details__caption">{{ __('text.Delivery_time') }}</p>
                    <p class="text">{{ $order->info['delivery'] }}</p>
                </div>
                <div class="order-details__payment order-details__item">
                    <p class="order-details__caption">{{ __('text.Payment_Method') }}</p>
                    <p class="text">{{ $order->info['payment'] ?? __('text.Another_Payment_Method') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
     @else
    <div class="profile__order-history">{{ __('text.any_previous_orders') }}</div>
    @endif
</div>
@endsection
@push('styles')
	<link href="{{ url('/css/csspages/profile.css') }}" rel="preload" as="style">
@endpush
@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ url('js/jspages/native/profile.js') }}"></script>
@endpush
