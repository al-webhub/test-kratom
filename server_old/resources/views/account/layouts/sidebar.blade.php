@php
	$current_route = Route::currentRouteName();
@endphp
<ul class="profile__sidebar-list">
    <li class="profile__sidebar-item">
        <a href="{{ url_locale('/account/order-history') }}" class="profile__sidebar-link {{ $current_route == 'order-history'? 'active': '' }}">
            <span class="icon-order"></span>
            <span class="text">{{ __('text.order_history') }}</span>
        </a>
    </li>
    <li class="profile__sidebar-item">
        <a href="{{ url_locale('/account/addresess') }}" class="profile__sidebar-link {{ $current_route == 'addresess'? 'active': '' }}">
            <span class="icon-home"></span>
            <span class="text">{{ __('text.addresess') }}</span>
        </a>
    </li>
    <li class="profile__sidebar-item">
        <a href="{{ url_locale('/account/edit-account') }}" class="profile__sidebar-link {{ $current_route == 'edit-account'? 'active': '' }}">
            <span class="icon-account"></span>
            <span class="text">{{ __('text.account_settings') }}</span>
        </a>
    </li>
    <li class="profile__sidebar-item">
        <a href="{{ url_locale('account/referral-network') }}" class="profile__sidebar-link {{ $current_route == 'transactions'? 'active': '' }}">
            <span class="icon-referral"></span>
            <span class="text">{{ __('text.referral_network') }}</span>
        </a>
    </li>
    <li class="profile__sidebar-item">
        <button class="profile__sidebar-link js-button" data-target="logout">
            <span class="icon-logout"></span>
            <span class="text">{{ __('text.logout') }}</span>
        </button>
    </li>
</ul>