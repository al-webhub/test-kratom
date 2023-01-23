<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use App\User;
use Aimix\Shop\app\Models\Attribute;
use Aimix\Shop\app\Models\Modification;
use Aimix\Shop\app\Models\Payment;

use Illuminate\Support\Facades\DB;
use Aimix\Shop\app\Http\Controllers\CatalogController as PackageCatalogController;

class ReferralsController extends \App\Http\Controllers\Controller
{
	public function index(Request $request){
		
		$users = User::whereHas('usermeta.referrals')->get();
		
		return view('referrals')->with('users', $users);
	}
}