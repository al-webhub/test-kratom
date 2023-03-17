@extends('layouts.app')

@section('content')
<div id="account-account" class="container-maxwidth background-wood-main">
  <div class="row">
    <div class="col-xs-12">
      {{ Breadcrumbs::render('account') }}
    </div>
  </div>

    <div class="row">
      <div id="content" class="col-sm-12">
    <div class="background-textile text-center">
    
      <h2>My Account</h2>
      <ul class="list-unstyled">
        <li><a href="{{ url('account/edit-account') }}">Edit your account information</a></li>
      </ul>
      <ul class="list-unstyled">
        <li><a href="{{ url('account/order-history') }}">View your order history</a></li>
      </ul>

         <h2>My Affiliate Account</h2>
      <ul class="list-unstyled">
       <li><a href="{{ url('account/referral-network') }}">Referral network</a></li>
      </ul>
    
      <h2>Newsletter</h2>
      <ul class="list-unstyled">
        <li><a href="{{ url('account/newsletter') }}">Subscribe / unsubscribe to newsletter</a></li>
      </ul>
      
          <span class="b-top"></span><span class="b-right"></span><span class="b-bottom"></span><span class="b-left"></span>
            <div class="row mt-1">
              <div class="col-xs-12">
                <a class="bnt-green" href="{{ url('logout') }}">Logout</a>
              </div>
            </div>
  </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
@endpush