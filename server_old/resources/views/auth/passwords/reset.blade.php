@extends('layouts.app')

@section('content')

<div id="account-reset" class="container-maxwidth background-wood-main">

  <div class="row">
    <div class="col-xs-12">
        {{ Breadcrumbs::render('page', 'Reset your password') }}
    </div>
  </div>

  <div class="row">
    <div id="content" class="col-sm-12">
    <div class="background-textile">
    
      <h1>Reset your password</h1>
			<form method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data" class="form-horizontal">
			<input type="hidden" name="email" value="{{ $email ?? old('email') }}" required>
      @csrf
        <div class="change-pass">
        <div class="wrapper">
          <div class="form-group password-wrapper">
            <label class="col-sm-2 control-label" for="input-password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="input-password">
                @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                @enderror
          </div>
          <div class="form-group password-wrapper">
            <label class="col-sm-2 control-label" for="input-confirm">Confirm</label>
              <input type="password" name="password_confirmation" id="input-confirm" class="form-control">
          </div>
          </div>
        </div>
        <div class="buttons clearfix edit-buttons">
            <a href="{{ url('login') }}" class="bnt-green">Back</a>
            <button type="submit" class="bnt-orang">Continue</button>
        </div>
        <div class="clear"></div>
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