@extends(backpack_view('blank'))

@php

@endphp

@section('header')
<nav aria-label="breadcrumb" class="d-none d-lg-block">
	<ol class="breadcrumb bg-transparent p-0 justify-content-end">
		<li class="breadcrumb-item text-capitalize"><a href="/admin/dashboard">Admin</a></li>
		<li class="breadcrumb-item text-capitalize active" aria-current="page">Реферальная система</li>
	</ol>
</nav>
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">Реферальная система</span>
      <small id="datatable_info_stack"></small>
    </h2>
  </div>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="">
      <div class="">

        <div class="row mb-0">
          <div class="col-6">
          </div>
          <div class="col-6">
              <div id="datatable_search_stack" class="float-right"></div>
          </div>
        </div>

        <div class="overflow-hidden mt-2">
	        <div class="user-table">
		        <div class="table-header table-row">
					<div>ID</div>
					<div>Name</div>
					<div>Email</div>
					<div>Рефералы</div>
					<div>Баланс, USD</div>
				</div>
				@foreach($users as $user)
					<div class="table-tr table-row">
						<div>{{ $user->id }}</div>
						<div>{{ $user->name }}</div>
						<div>{{ $user->email }}</div>
						<div>{{ $user->usermeta->referrals->count() }}</div>
						<div>{{ $user->usermeta->bonusBalance }}</div>
					</div>
					@foreach($user->referrals as $usermeta)
						<div class="table-tr table-row table-row-2">
							<div>{{ $usermeta->user? $usermeta->user->id: '' }}</div>
							<div>{{ $usermeta->user? $usermeta->user->name: '' }}</div>
							<div>{{ $usermeta->user? $usermeta->user->email: '' }}</div>
							<div>{{ $usermeta->referrals->count() }}</div>
							<div>{{ $usermeta->bonusBalance }}</div>
						</div>
						@foreach($usermeta->referrals as $usermeta)
							<div class="table-tr table-row table-row-3">
								<div>{{ $usermeta->user? $usermeta->user->id: '' }}</div>
								<div>{{ $usermeta->user? $usermeta->user->name: '' }}</div>
								<div>{{ $usermeta->user? $usermeta->user->email: '' }}</div>
								<div>{{ $usermeta->referrals->count() }}</div>
								<div>{{ $usermeta->bonusBalance }}</div>
							</div>
						@endforeach
					@endforeach
				@endforeach
	        </div>
        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </div>

  </div>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  <style>
	  .user-table {
		  width: 100%;
	  }
	  .table-header {
		  font-weight: 600;
	  }
	  .table-row {
		  display: flex;
	  }
	  .table-row > div,
	  .table-row > div {
		  padding: 5px;
	  }
	  .table-row > div:nth-child(1) {
		  width: 50px;
	  }	  
	  .table-row > div:nth-child(2) {
		  width: 200px;
	  } 
	  .table-row > div:nth-child(3) {
		  width: 300px;
	  }
	  .table-row > div:nth-child(4) {
		  width: 100px;
	  }
	  .table-row-2 {
		  color: #777;
		  font-size: 15px;
	  }
	  .table-row-3 {
		  color: #999;
		  font-size: 13px;
	  }
  </style>
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
@endsection
