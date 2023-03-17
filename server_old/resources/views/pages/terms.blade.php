@extends('layouts.app')

@section('meta_title', $page->meta_title)
@if($page->meta_description)
	@section('meta_description', $page->meta_description)
@else
	@section('meta_description', __('seo.page_description', ['title' => 'Frequently Asked Questions']))
@endif

@section('content')
<div id="information-information" class="container-maxwidth">
  <div class="row">
    <div class="col-xs-12">
    {{ Breadcrumbs::render('page', $page->title) }}
    </div>
  </div>

  <div class="container">
    <div class="col-sm-12">
      <h1>{{ $page->h1 ?? $page->title }}</h1>

<div class="show-main">
    <img src="{{ url('image/terms.png') }}">
</div>

<div class="show-tablet">
 <img src="{{ url('image/terms_tab.png') }}">
</div>

<div class="show-mob">
 <img src="{{ url('image/terms_mob.png') }}">
</div>

      <span class="b-top"></span><span class="b-right"></span><span class="b-bottom"></span><span class="b-left"></span>
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
@endpush