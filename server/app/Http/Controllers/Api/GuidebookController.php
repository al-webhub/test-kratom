<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use Backpack\NewsCRUD\app\Models\Article;

class GuidebookController extends \App\Http\Controllers\Controller
{ 
  public function index(Request $request) {

    $articles = Article::published()->where('lang', request('lang'))->orderBy('created_at', 'desc');

    $per_page = 12;

    $articles = $articles->paginate($per_page);

    return response()->json($articles);
  }

  public function show(Request $request, $slug) {
    try{
      $article = Article::where('slug', $slug)->firstOrFail();
    }catch(ModelNotFoundException $e) {
      return response()->json($e->getMessage(), 404);
    }

    return $article;
  }
}
