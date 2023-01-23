<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aimix\Shop\app\Models\Order;
use App\Models\Product;
use Backpack\NewsCRUD\app\Models\Article;
use Aimix\Review\app\Models\Review;
use Aimix\Banner\app\Models\Banner;
use App\Models\Faq;
use Backpack\PageManager\app\Models\Page;
use Spatie\Browsershot\Browsershot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		$main_page = array(
				'page' => Page::find(4)->withFakes(),
				'banners' => Banner::orderBy('lft', 'ASC')->get(),
				'reviews' => Review::where('is_moderated', 1)->where('parent_id', 0)->where('product_id', null)->orderBy('created_at', 'desc')->get(),
				'articles' => Article::published()->where('featured', 1)->orderBy('created_at', 'desc')->take(4)->get(),
				'popular_products' => Product::where('is_hit', 1)->get()
	    );
	    
		return view('index', $main_page);
    }
    
    
    // SHOP
    public function shopSeen(Request $request, $id){    
/*
	    if($request->session()->has('recently')){
	    	$session_recently = $request->session()->get('recently');
			
			$key = array_search($id, $session_recently);
			if($key !== false)
				unset($session_recently[$key]);
	    }
	    
	    $session_recently[] = $id;
	    
	    $request->session()->put('recently', array_slice($session_recently, -6));
	    
	    header('Content-Type: image/gif');
		echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');	
*/    
    }
    
    //SITEMAP
    public function getSitemap(Request $request){
		$lang = request()->segment(1);
		return response()->file(public_path("/sitemap-$lang.xml"));
    }
    
    // ACCOUNT
    public function orderHistory(Request $request){
	    $orders = Order::where('usermeta_id', \Auth::user()->usermeta->id)->orderBy('created_at', 'desc')->get();
	    return view('account.order-history')->with('orders', $orders);
    }
    
    // FAQ
    public function faq(Request $request){
	  $faqs = Faq::orderBy('lft')->get();
	  $page = Page::find(5)->withFakes();
	  return view('faq.index')->with('faqs', $faqs)->with('page', $page);
    }

    // public function img() {
    //     // $script = 'setTimeout(function() {
    //     //     document.querySelectorAll(".f0n8F").forEach(function(item) {item.classList.add("FATdn")})
    //     //     document.querySelector("input[name=username]").value = "kratomsocial@gmail.com"; 
    //     //     document.querySelector("input[name=password]").value = "ss22rr44"; 
    //     //     document.querySelector("button[type=submit]").removeAttribute("disabled"); 
    //     //     document.querySelector("button[type=submit]").click();
    //     // }, 1000)';

    //     $script = 'setTimeout(function() {
    //         document.querySelector(".coreSpriteFacebookIcon").click();
    //     }, 1000)';

    //     $script_fb = 'setTimeout(function() {
    //         document.querySelector("input#email").value = "kratomsocial@gmail.com";
    //         document.querySelector("input#pass").value = "ss22rr44";
    //         document.querySelector("#loginbutton").click();
    //     }, 1000)';

    //     Browsershot::url('https://www.instagram.com/helper.health/')
    //                ->windowSize(1920, 800)
    //             //    ->click('.aOOlW') // Accept cookies
    //             //    ->delay(1000)
    //             //    ->setOption('addScriptTag', json_encode(['content' => $script]))
    //             //    ->delay(2000)
    //             //    ->setOption('addScriptTag', json_encode(['content' => $script_fb]))
    //             //    ->delay(5000)
    //                ->save(public_path('test.png'));

    //     return Browsershot::url('https://www.instagram.com/helper.health/')->delay(1000)->bodyHtml();
    // }

    public function img() {
        Browsershot::url('https://www.facebook.com/kratomhelp')
                   ->device('iPad Pro')
                   ->windowSize(1366, 815)
                   ->landscape(true)
                //    ->click('.aOOlW') // Accept cookies
                   ->save(public_path('test.png'));

        // Browsershot::url('https://www.facebook.com/kratomhelp')
        //             ->device('iPhone X')
        //             ->windowSize(375, 820)
        //             ->landscape(true)
        //         //    ->click('.aOOlW') // Accept cookies
        //             ->save(public_path('test.png'));

        return Browsershot::url('https://www.facebook.com/kratomhelp')->device('iPad Pro')->bodyHtml();
    }
}
