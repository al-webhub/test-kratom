<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Support\Facades\DB;
use Backpack\PageManager\app\Models\Page;

class NewsController extends Controller
{
    public function index(Request $request) {
      $articles = Article::published()->orderBy('created_at', 'desc');
      
      if($request->category) {
        $category = $request->category;
        
        $articles = $articles->whereHas('category', function(Builder $query) use($category) {
          $query->where('name', $category);
        });
      }
      
      $articles = $articles->paginate(12);
      $page = Page::find(6)->withFakes();
      
      if($request->isJson)
        return response()->json(['articles' => $articles]);
      else
        return view('news.index')->with('articles', $articles)->with('page', $page);
    }
    
    public function show($slug_or_lang, $slug = null) {
	    $slug = $slug? $slug: $slug_or_lang;
      	$article = Article::published()->where('slug', $slug)->first();
      	
      	if(!$article)
      		abort(404);
      	
	      $article = $article->withFakes();
	      $similars = Article::published()->where('id', '!=', $article->id)->inRandomOrder()->limit(4)->get();
	      
		return view('news.show')->with('article', $article)->with('similars', $similars);
      
//       return view('news.show')->with('article', $article)->with('prev', $prev)->with('next', $next)->with('prev_title', $prev_title)->with('next_title', $next_title);
    }
}
