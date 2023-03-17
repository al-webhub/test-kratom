@extends('layouts.app')

@section('meta_title', 'Privacy Policy | Kratomhelper')
@section('meta_description', __('seo.page_description', ['title' => 'Privacy Policy']))

@section('content')
<div id="information-information" class="container-maxwidth">
  <div class="row">
    <div class="col-xs-12">
    {{ Breadcrumbs::render('page', $page->title) }}
    </div>
  </div>

  <div class="container">
      <div class="col-sm-12">
      <h1>Privacy Policy</h1>
      <div class="show-main">
        <img src="{{ url('image/privacy_polycy.png') }}">
    </div>
    <div class="show-tablet">
    <img src="{{ url('image/privacy_polycy_tab.png') }}">
    </div>
    <div class="show-mob">
    <img src="{{ url('image/privacy_polycy_mob.png') }}">
    </div>
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
@endpush