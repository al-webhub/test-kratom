@extends('layouts.app')

@section('content')
<div id="account-password" class="container-maxwidth background-wood-main">
  <div class="row">
    <div class="col-xs-12">
      {{ Breadcrumbs::render('accountPage', 'Change Password') }}
    </div>
  </div>
  <div class="row">
    <div id="content" class="col-sm-12">
    <div class="background-textile">
      <h1>{{ __('text.Change_Password') }}</h1>
      <form action="{{ url('account/changePassword') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
      @csrf
        <div class="change-pass">
          <div class="wrapper">
            <div class="form-group required password-wrapper">
              <label class="control-label" for="input-password">{{ __('text.Password') }}</label>
                <input type="password" name="password" placeholder="Password" id="input-password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group required password-wrapper">
              <label class="control-label" for="input-confirm">Password Confirm</label>
                <input type="password" name="password_confirmation" placeholder="Password Confirm" id="input-confirm" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
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