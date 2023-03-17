@extends('layouts.app')

@section('content')
<div id="account-newsletter" class="container-maxwidth background-wood-main">

<div class="row">
  <div class="col-xs-12">
    {{ Breadcrumbs::render('accountPage', 'Newsletter') }}
  </div>
</div>

<div class="row">
  <div id="content" class="col-sm-12">
  <div class="background-textile">
  
    <h1>Newsletter Subscription</h1>
    <form action="{{ url('account/edit') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @csrf

    <div class="form-group subscribe">
        <label class="col-sm-2 control-label">Subscribe</label>
        <div class="col-sm-10 wrapper">
            <label class="radio-inline delivery-radio">
            <input type="radio" name="subscription" value="1" @if($user->usermeta->subscription) checked @endif>
            <span class="custome-radio"></span>
            <span>Yes </span>
            </label>
        <label class="radio-inline delivery-radio">
            <input type="radio" name="subscription" value="0" @if(!$user->usermeta->subscription) checked @endif>
            <span class="custome-radio"></span>
            <span>No</span>
        </label>
        </div>
    </div>
      <div class="buttons clearfix edit-buttons">
            <a href="{{ url('account') }}" class="bnt-green">Back</a>
          <input type="submit" value="Continue" class="bnt-orang">
      </div>
    </form>
    
        <span class="b-top"></span><span class="b-right"></span><span class="b-bottom"></span><span class="b-left"></span>
</div>
</div>
  </div>
</div>

@endsection

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
@endpush