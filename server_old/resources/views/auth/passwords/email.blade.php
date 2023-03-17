@extends('layouts.app')

@section('content')
<div id="account-forgotten" class="container-maxwidth background-wood-main">
  <div class="row">
    <div class="col-xs-12">
        {{ Breadcrumbs::render('page', 'Forgotten Password') }}
    </div>
  </div>
    <div class="row">
    <div id="content" class="col-sm-12">
    <div class="background-textile">
      <h1>Forgot Your Password?</h1>
      <p>Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.</p>
      <form method="POST" action="{{ route('password.email') }}" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="form-group required reset-pass">
          <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
          <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="E-Mail Address" id="input-email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        </div>
        <div class="buttons clearfix edit-buttons">
            <a href="{{ url('login') }}" class="bnt-green">Back</a>
            <input type="submit" value="Continue" class="bnt-orang">
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