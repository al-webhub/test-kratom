@section('breadcrumbs', Breadcrumbs::render('accountPage', __('text.referral_network')))

@extends('account.layouts.app')

@section('account')                         
<div class="profile__info">
    <p class="profile__info__caption">{{ __('text.financial_information') }}</p>
    <div class="referral-info">
        <!-- update -->
        <ul class="referral-info__list">
            <li class="referral-info__item">
                <p class="type">{{ __('text.Bonuses_earned_total') }}</p>
                <p class="description">USD {{ $user->usermeta->TotalEarnedBonuses }}</p>
            </li>
            <li class="referral-info__item">
                <p class="type">{{ __('text.cashback_for_purchases') }}</p>
                <p class="description">USD {{ $user->usermeta->transactions->where('type', 'cashback')->sum('change') }}</p>
            </li>
            <li class="referral-info__item">
                <p class="type">{{ __('text.earned_in_partner') }}</p>
                <p class="description">USD {{ $user->usermeta->transactions->where('type', 'bonus')->sum('change') }}</p>
            </li>
            <li class="referral-info__item">
                <p class="type">{{ __('text.earned_for_reviews') }}</p>
                <p class="description">USD {{ $user->usermeta->transactions->where('type', 'review')->sum('change') }}</p>
            </li>
            <li class="referral-info__item" style="color: #ACDA53;">
                <p class="type">{{ __('text.Your_current_balance') }}</p>
                <p class="description">USD @{{ balance }}</p>
            </li>
        </ul>
        <!-- /update -->
        <div class="referral-withdrawal">
            <button class="main-button-color js-button" :class="{disabled: balance < 10}" data-target="withdrawal">
                <span class="text">{{ __('text.request_withdrawal') }}</span>
            </button>
            <p>{{ __('text.available') }}:</p>
            <ul>
                <li>{{ __('text.once_a_day') }}</li>
                <li>{{ __('text.balance_is_above') }}</li>
            </ul>
        </div>
    </div>
    <div class="referral-container">
        <p class="profile__info__caption">{{ __('text.my_referral_network') }}</p>
        <p class="referral-link-text">{{ __('text.Copy_your_referral') }}</p>
        <div class="referral-link">
            <label class="input__wrapper">
                <input type="text" class="main-input" readonly value="{{ url('/?ref=' . $user->referral_code) }}">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
            </label>
            <button class="copy-referral-link">
                <span class="icon-copy"></span>
            </button>
        </div>
        <ul class="general-tabs__list">
            <li class="general-tabs__item" :class="{active: currentTab == 'referrals'}" @click="currentTab = 'referrals'">{{ __('text.Friends_Network') }}</li>
            <li class="general-tabs__item" :class="{active: currentTab == 'transactions'}" @click="currentTab = 'transactions'">{{ __('text.transactions') }}</li>
        </ul>
        <div class="referral-history" v-if="currentTab == 'referrals'">
            <div class="referral-history__header">
                <p class="referral-history__name referral-history-position-1-lvl">{{ __('text.My_referral') }}<br>(1st lvl)</p>
                <p class="referral-history__name referral-history-position-2-lvl">{{ __('text.Referral_partners') }}<br>(2nd lvl)</p>
                <p class="referral-history__name referral-history-position-3-lvl">{{ __('text.Referral_partners') }}<br>(3nd lvl)</p>
                <p class="referral-history__name referral-history-position-data">{{ __('text.add_date') }}</p>
                <p class="referral-history__name referral-history-position-last"></p>
            </div>
            <div class="referral-history__body"  v-if="referrals.data.length">
                <ul class="referral-history__list js-drop-button js-drop-item" v-for="(referral, key) in referrals.data">
                    <li class="referral-history__item referral-history-position-1-lvl">
                        <div class="main-wrapper">
                            <p class="main-type">{{ __('text.My_referral') }} (1st lvl)</p>
                            <p class="text">@{{ referral.fullname }}</p>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-2-lvl">
                        <p class="text">@{{ totalRefsLvl2(referral) }}</p>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.Referral_partners') }} (2nd lvl)</p>
                                <p class="description">@{{ totalRefsLvl2(referral) }}</p>
                            </div>
                            <ul class="referral-history__sub-list">
                                <li class="referral-history__sub-item"v-for="ref_lvl_2 in referral.referrals">@{{ ref_lvl_2.fullname }}</li>
                            </ul>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-3-lvl">
                        <p class="text">@{{ totalRefsLvl3(referral) }}</p>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.Referral_partners') }} (3rd lvl)</p>
                                <p class="description">@{{ totalRefsLvl3(referral) }}</p>
                            </div>
                            <ul class="referral-history__sub-list">
                                <template v-for="ref_lvl_2 in referral.referrals">
                                    <li class="referral-history__sub-item" v-for="ref_lvl_3 in ref_lvl_2.referrals">@{{ ref_lvl_3.fullname }}</li>
                                </template>
                            </ul>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-data">
                        <p class="text">@{{ referral.created_at }}</p>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.add_date') }}</p>
                                <p class="description">@{{ referral.created_at }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-last">
                        <span class="icon-drop"></span>
                    </li>
                </ul>
                <!-- update -->
                <div v-if="referrals.last_page != referrals.current_page" @click="loadmore()" style="text-align:center; cursor:pointer;padding:10px">
                    {{ __('text.Load_more') }}
                </div>
                <!-- /update -->
            </div>
            <div class="referral-info-body referra-empty" v-else>
                <p>{{ __('text.network_is_empty') }}</p>
            </div>
        </div>
        <!-- Transactions  -->
        <div class="referral-history" v-if="currentTab == 'transactions'">
            <div class="referral-history__header">
                <p class="referral-history__name referral-history-position-data">{{ __('text.Transaction_date') }}</p>
                <p class="referral-history__name referral-history-position-descrip">{{ __('text.description') }}</p>
                <p class="referral-history__name referral-history-position-amount">{{ __('text.Status') }}</p>
                <p class="referral-history__name referral-history-position-amount">{{ __('text.Amount') }}</p>
                <p class="referral-history__name referral-history-position-balance">{{ __('text.Current_balance') }}</p>
            </div>
            <div class="referral-history__body">
                <ul class="referral-history__list referral-history__list-transactions js-drop-button js-drop-item" v-for="transaction in transactions.data">
                    <li class="referral-history__item referral-history-position-data">
                        <div class="main-wrapper">
                            <p class="main-type">{{ __('text.Transaction_date') }}</p>
                            <p class="text">@{{ transaction.created_at }}</p>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-descrip">
                        <p class="text" v-html="transaction.description"></p>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.description') }}</p>
                                <div class="description-text" v-html="transaction.description"></div>
                            </div>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-amount">
                        <p class="text" style="text-transform: uppercase">@{{ transaction.is_completed? 'done': 'pending' }}</p>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.Status') }}</p>
                                <p class="description">@{{ transaction.is_completed }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history-position-amount">
                        <p class="text">@{{ transaction.change }}</p>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.Amount') }}</p>
                                <p class="description">@{{ transaction.change }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history__item-balance referral-history-position-balance">
                        <template v-if="transaction.balance">
                        	<p class="text">USD @{{ transaction.balance }}</p>
                        </template>
                        <template v-else>
                        	<p class="text">–</p>
                        </template>
                        <div class="referral-history__sub">
                            <div class="wrapper">
                                <p class="type">{{ __('text.Current_balance') }}</p>
                                <template v-if="transaction.balance">
                                	<p class="description">USD @{{ transaction.balance }}</p>
                                </template>
		                        <template v-else>
		                        	<p class="description">–</p>
		                        </template>	
                                	
                            </div>
                        </div>
                    </li>
                    <li class="referral-history__item referral-history__item-icon-drop">
                        <span class="icon-drop"></span>
                    </li>
                </ul>
                <!-- update -->
                <div v-if="transactions.last_page != transactions.current_page" @click="loadmore()" style="text-align:center; cursor:pointer;padding:10px">
                    {{ __('text.Load_more') }}
                </div>
                <!-- /update -->
            </div>
            <div class="referral-info-body referra-empty" v-if="!transactions.total">
                <p>{{ __('text.have_any_transactions') }}</p>
            </div>
        </div>
        
            <!-- //Transactions  -->
    </div>
</div>
    
<form action="{{ url('transaction/create') }}" method="post" class="form">
    @csrf
    <input type="hidden" name="transaction_type" value="withdraw">
    <section class="popup popup-withdrawal" data-target="withdrawal">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.request_withdrawal') }}</p>
        <div class="popup__body">
            <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                <input type="text" name="transaction_method" :value="selectedPayment" class="main-input js-input js-drop-input js-drop-button" required> 
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Choose_payment_method') }}<span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                <span class="icon-drop"></span>
                <div class="general-drop__list">
                    <div class="general-drop__item general-drop__item-select">
                        <div class="text">{{ __('text.Please_select') }}</div>
                    </div>
                    <div class="general-drop__item js-drop-contains" v-for="(payment, index) in paymentMethod" @click="selectedPayment = payment">
                        <span class="icon-active"></span>
                        <div class="text">@{{ payment }}</div>
                    </div>
                </div>
            </div>
            <div class="withdrawal__input-wrapper">
	            <input type="hidden" name="transaction_requisites" v-model="requisites">
	            <template v-if="selectedPayment == 'Bank card'">
	                <p>{{ __('text.Card_number') }}</p>
	                <ul class="withdrawal__list">
	                    <li class="withdrawal__item">
	                        <input maxlength="4" class="js-withdrawal-decor-input main-input" type="text" placeholder="XXXX" 
	                        v-model="requisite.cardnumber.first" required>
	                    </li>
	                    <li class="withdrawal__item">
	                        <input maxlength="4" class="js-withdrawal-decor-input main-input" type="text" placeholder="XXXX" 
	                        v-model="requisite.cardnumber.second" required>
	                    </li>
	                    <li class="withdrawal__item">
	                        <input maxlength="4" class="js-withdrawal-decor-input main-input" type="text" placeholder="XXXX" 
	                        v-model="requisite.cardnumber.third" required>
	                    </li>
	                    <li class="withdrawal__item">
	                        <input maxlength="4" class="js-withdrawal-decor-input main-input" type="text" placeholder="XXXX" 
	                        v-model="requisite.cardnumber.fourth" required>
	                    </li>
	                </ul>
	            </template>
	            <template v-else-if="selectedPayment == 'Paypal'">
	            	<label class="input__wrapper js-input-wrapper">
	            		<input type="text" class="main-input js-input" v-model="requisite.paypal.email" required>
	            		<span class="custome-placeholder__wrapper">
		                    <span class="custome-placeholder__before"></span>
		                    <span class="custome-placeholder__text"><span class="inner-text">Email {{ __('text.address') }}</span></span>
		                    <span class="custome-placeholder__after"></span>
		                </span>
	            	</label>
	            </template>
	            <template v-else-if="selectedPayment == 'Western Union'">
	            	<label class="input__wrapper js-input-wrapper">
	            		<input type="text" class="main-input js-input" v-model="requisite.western.name" required>
	            		<span class="custome-placeholder__wrapper">
		                    <span class="custome-placeholder__before"></span>
		                    <span class="custome-placeholder__text"><span class="inner-text">{{ __('text.Full_name') }}</span></span>
		                    <span class="custome-placeholder__after"></span>
		                </span>
	            	</label>
	            	<label class="input__wrapper js-input-wrapper">
	            		<input type="text" class="main-input js-input" v-model="requisite.western.phone" required>
	            		<span class="custome-placeholder__wrapper">
		                    <span class="custome-placeholder__before"></span>
		                    <span class="custome-placeholder__text"><span class="inner-text">{{ __('text.Phone') }}</span></span>
		                    <span class="custome-placeholder__after"></span>
		                </span>
	            	</label>
	            	<label class="input__wrapper js-input-wrapper">
	            		<input type="text" class="main-input js-input" v-model="requisite.western.country" required>
	            		<span class="custome-placeholder__wrapper">
		                    <span class="custome-placeholder__before"></span>
		                    <span class="custome-placeholder__text"><span class="inner-text">{{ __('text.Country') }}</span></span>
		                    <span class="custome-placeholder__after"></span>
		                </span>
	            	</label>
	            	<label class="input__wrapper js-input-wrapper">
	            		<input type="text" class="main-input js-input" v-model="requisite.western.city" required>
	            		<span class="custome-placeholder__wrapper">
		                    <span class="custome-placeholder__before"></span>
		                    <span class="custome-placeholder__text"><span class="inner-text">{{ __('text.City') }}</span></span>
		                    <span class="custome-placeholder__after"></span>
		                </span>
	            	</label>
	            </template>
            </div>
            <div class="withdrawal__wrapper">
                <div class="product__calc">
                    <button type="button" class="calc_button" @click="withdrawAmount - 1 > 0? withdrawAmount-- : withdrawAmount = 0">
                        <span class="text">-</span>
                    </button>
                    <input class="calc-input" type="number" name="transaction_change" class="form-control checkout__input" :max="balance" step="0.01" min="10" v-model="withdrawAmount" @keydown="withdrawAmount > balance? withdrawAmount = balance : true" @keyup="withdrawAmount > balance? withdrawAmount = balance : true" required>
                    <button type="button" class="calc_button" @click="withdrawAmount + 1 > balance? withdrawAmount = balance : withdrawAmount++">
                        <span class="text">+</span>
                    </button>
                </div>
                <p>{{ __('text.Maximum') }}: <strong>$ @{{ balance }}</strong> {{ __('text.due_to_your_balance') }}</p>
            </div>
            <button class="main-button-color main-button-color-popup">
                <span class="text">{{ __('text.send_request') }}</span>
            </button>
        </div>
    </section>
</form>
@endsection
@push('styles')
	<link href="{{ url('/css/csspages/profile.css?v='.config('settings.cache_v')) }}" rel="preload" as="style">
@endpush
@push('scripts')
    <script>
    var transactions = @json($transactions);
    var referrals = @json($referrals);
    var balance = @json($balance);
    </script>
    <script src="{{ url('js/account/transactions.js?v='.config('settings.cache_v')) }}"></script>
    <script src="{{ url('js/jspages/native/profile.js?v='.config('settings.cache_v')) }}"></script>
    <script>
        
        let cardInput = document.querySelector('.js-withdrawal-input');
        let cardItems = document.querySelectorAll('.js-withdrawal-decor-input');
        let generalValueArray = [];
        
        cardItems.forEach(item => {
            item.addEventListener('keyup', function(){
                if(item.value.length == 4) {
                    if(!generalValueArray.includes(item.value)) {
                        generalValueArray.push(item.value);
                        cardInput.value = generalValueArray;
                        let value = String(cardInput.value).replace(/,/g, '');
                        cardInput.value = value;
                        return;
                    }else {
                        return;
                    }
                }
            });
        });
    // Copy 
    
        let copyButton = document.querySelector(".copy-referral-link");
        
        copyButton.addEventListener('click', function(){
            let wrapper = this.closest(".referral-link");
            let input = wrapper.querySelector('.main-input');
            
            input.select();
            input.setSelectionRange(0, 99999);

            document.execCommand("copy");
            noty("info", "Link copied to clipboard");
        });

    // //Copy
    
    </script>
@endpush
