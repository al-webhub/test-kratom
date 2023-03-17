
@extends('layouts.app')

@section('content')

<main>
    {{ Breadcrumbs::render('page', '404') }}
    <div class="error-page">
        <div class="general-decor-figure"></div>
        <div class="general-decor-figure"></div>
        <h1 class="main-caption">404</h1>
        <p>the page you are looking for not availble</p>
        <a href="/" class="general-more">
            <span class="text">go to home</span>
            <span class="icon-arrow-right"></span>
        </a>
    </div>
</main>

@endsection

@push('styles')
	<link href="{{ url('/css/csspages/error.css') }}" rel="preload" as="style" onload="this.rel='stylesheet'">
@endpush

@push('scripts')
    <script src="{{ url('js/jspages/native/common.js') }}"></script>
@endpush