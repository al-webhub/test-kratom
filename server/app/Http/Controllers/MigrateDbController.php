<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Modification;
use App\Models\Category;
use App\Models\Review;
use App\Models\Banner;

use Backpack\Store\app\Models\Product as NewProduct;
use Backpack\Store\app\Models\Attribute as NewAttribute;
use Backpack\Store\app\Models\Category as NewCategory;

use Backpack\Articles\app\Models\Article as NewArticle;
use Backpack\Reviews\app\Models\Review as NewReview;

use Backpack\Banners\app\Models\Banner as NewBanner;

class MigrateDbController extends Controller
{
  public function createArticles() {
    $articles = \DB::table('articles')->select('articles.*')->get();

    foreach($articles as $article) {

      $lang_segments = explode('_', $article->language_abbr);

      NewArticle::create([
        'lang' => $lang_segments[0],
        'title' => $article->title,
        'slug' => $article->slug,
        'content' => $article->content,
        'excerpt' => mb_substr($article->short_desc, 0, 255),
        'image' => $article->image,
        'date' => $article->date,
        'seo' => json_decode($article->extras),
      ]);
    }
  }

  public function createReviews() {
    $reviews = Review::where('product_id', null)->get();

    foreach($reviews as $review) {

      $extras = [
        "owner" =>  [
            "email" => $review->email,
            "photo" => $review->file,
            "fullname" => $review->name
        ],
        "method" => "common"
      ];

      $product = NewProduct::inRandomOrder()->first();

      $review = NewReview::create([
        'is_moderated' => $review->is_moderated,
        'text' => $review->text,
        'extras' => $extras,
        'rating' => rand(3,5),
        'likes' => 	$review->likes,
        'dislikes' => $review->dislikes,
        'reviewable_id' => $product->id,
        'reviewable_type' => 'Backpack\Store\app\Models\Product'
      ]);
    }
  }

  public function createProductReviews($reviews, $product) {

    foreach($reviews as $review) {

      $extras = [
        "owner" =>  [
            "email" => $review->email,
            "photo" => $review->file,
            "fullname" => $review->name
        ],
        "method" => "common"
      ];


      $review = NewReview::create([
        'is_moderated' => $review->is_moderated,
        'text' => $review->text,
        'extras' => $extras,
        'rating' => rand(3,5),
        'likes' => 	$review->likes,
        'dislikes' => $review->dislikes,
        'reviewable_id' => $product->id,
        'reviewable_type' => 'Backpack\Store\app\Models\Product'
      ]);
    }

  }

  public function createProducts() {

    $old_products = Product::all();

    foreach($old_products as $old_product) {

      $modifications = $old_product->modifications()
                                   ->whereIn('language_abbr', ['en_US'])
                                   ->where('is_default', 0)
                                   ->get();

      $modifications = $modifications->sortBy(function ($item, $key) {
        return (float)$item->price;
      });

      $parent_id = null;

      foreach($modifications as $modification) {
        $base_product = $modification->product;

        $product = new NewProduct;

        $product->setTranslation('name', 'en', $base_product->getTranslation('name', 'en'))
                ->setTranslation('name', 'ru', $base_product->getTranslation('name', 'ru'));

        $product->setTranslation('short_name', 'en', $modification->name);

        if(!$parent_id) 
          $product->setTranslation('content', 'en', $base_product->getTranslation('description', 'en'))
                  ->setTranslation('content', 'ru', $base_product->getTranslation('description', 'ru'));

        if(!$parent_id)
          $product->setTranslation('seo', 'en', $base_product->getTranslation('extras', 'en'))
                  ->setTranslation('seo', 'ru', $base_product->getTranslation('extras', 'ru'));

        if(!$parent_id)          
          $product->images = [
            [
              'alt' => '',
              'title' => '',
              'src' =>  $old_product->image
            ]
          ];

        $product->price = $modification->price;
        $product->parent_id = $parent_id;

        $product->save();
        
        // Create product reviews
        if(!$parent_id)
          $this->createProductReviews($base_product->reviews, $product);
        
        // Attach categories
        if(!$parent_id)
          $product->categories()->attach($base_product->category_id);
        
        // Attach Attributes
        $this->attachAttrs($product, $modification, $base_product);

        if(!$parent_id){
          $parent_id = $product->id;
        }
      }

    }

    //dd($products);
  }

  private function attachAttrs($product, $modification, $base_product) {
    // WEIGHT
    $weight = (int)filter_var($modification->name, FILTER_SANITIZE_NUMBER_INT);
    $product->attrs()->attach(1, ['value' => $weight]);

    // SLIMULATION
    if($base_product->stimulation)
      $product->attrs()->attach(5, ['value' => $base_product->stimulation]);

    // RELAXATION
    if($base_product->relaxation)
      $product->attrs()->attach(6, ['value' => $base_product->relaxation]);

    // EPHORIA
    if($base_product->euphoria)
      $product->attrs()->attach(7, ['value' => $base_product->euphoria]);
  }

  public function createCategories() {
    $old_categories = Category::all();

    foreach($old_categories as $old_category) {

      $category = new NewCategory;

      $category->setTranslation('name', 'en', $old_category->getTranslation('name', 'en'))
               ->setTranslation('name', 'ru', $old_category->getTranslation('name', 'ru'));

      $category->setTranslation('content', 'en', $old_category->getTranslation('description', 'en'))
              ->setTranslation('content', 'ru', $old_category->getTranslation('description', 'ru'));

      $category->setTranslation('seo', 'en', $old_category->getTranslation('extras', 'en'))
              ->setTranslation('seo', 'ru', $old_category->getTranslation('extras', 'ru'));  
      
      $category->slug = $old_category->slug;    

      $category->save();
    }

    $categories = [
      [
        'en' => 'White kratom',
        'ru' => 'Белый кратом'
      ],[
        'en' => 'Red kratom',
        'ru' => 'Красный кратом'
      ],[
        'en' => 'Green kratom',
        'ru' => 'Зеленый кратом'
      ]
    ];

    foreach($categories  as $name) {
      $category = new NewCategory;
      $category->setTranslation('name', 'en', $name['en'])
              ->setTranslation('name', 'ru', $name['ru']);

      $category->slug = \Str::slug($name['en']);
      
      $category->save();
    }

  }

  public function createAttributes() {
    $this->createWeightAttribute();
    $this->createColorAttribute();
    $this->createRegionAttribute();
    $this->createTypeAttribute();

    $this->createStimulationAttribute();
    $this->createRelaxationAttribute();
    $this->createEuphoriaAttribute();
  }

  private function createWeightAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Weight')
              ->setTranslation('name', 'ru', 'Вес');
              
    $attribute->setTranslation('si', 'en', 'g.')
              ->setTranslation('si', 'ru', 'гр.');
              
    $attribute->setTranslation('default_value', 'en', 50)
              ->setTranslation('default_value', 'ru', 50);

    $attribute->setTranslation('values', 'en', [
      'min' => 5,
      'max' => 10000,
      'step' => 5
    ]);

    $attribute->type = ['type' => 'number'];

    $attribute->save();

    $attribute->categories()->attach([1,2]);
  }

  private function createColorAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Color')
              ->setTranslation('name', 'ru', 'Цвет');

    $attribute->setTranslation('values', 'en', ['White', 'Red', 'Green'])
              ->setTranslation('values', 'ru', ['Белый', 'Красный', 'Зеленый']);

    $attribute->type = ['type' => 'radio'];

    $attribute->save();
    $attribute->categories()->attach(1);
  }

  private function createRegionAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Region')
              ->setTranslation('name', 'ru', 'Регион');

    $attribute->setTranslation('values', 'en', ['Thai', 'Borneo', 'Sumatra', 'Malay'])
              ->setTranslation('values', 'ru', ['Тайланд', 'Борнео', 'Суматра', 'Малайзия']);

    $attribute->type = ['type' => 'radio'];

    $attribute->save();
    $attribute->categories()->attach([1,2]);
  }

  private function createTypeAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Type')
              ->setTranslation('name', 'ru', 'Тип');

    $attribute->setTranslation('values', 'en', ['Seed', 'Pill', 'Powder'])
              ->setTranslation('values', 'ru', ['Семена', 'Таблетки', 'Порошок']);

    $attribute->type = ['type' => 'radio'];

    $attribute->save();
    $attribute->categories()->attach([1,2]);
  }

  private function createStimulationAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Stimulation')
              ->setTranslation('name', 'ru', 'Стимуляция');

    $attribute->setTranslation('values', 'en', ['min' => 0, 'max' => 100, 'step' => 1]);
    $attribute->setTranslation('default_value', 'en', 50);

    $attribute->type = ['type' => 'number'];

    $attribute->save();
    $attribute->categories()->attach(1);
  }

  private function createRelaxationAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Relaxation')
              ->setTranslation('name', 'ru', 'Релаксация');

    $attribute->setTranslation('values', 'en', ['min' => 0, 'max' => 100, 'step' => 1]);
    $attribute->setTranslation('default_value', 'en', 50);

    $attribute->type = ['type' => 'number'];

    $attribute->save();
    $attribute->categories()->attach(1);
  }

  private function createEuphoriaAttribute() {
    $attribute = new NewAttribute;

    $attribute->setTranslation('name', 'en', 'Euphoria')
              ->setTranslation('name', 'ru', 'Эйфория');

    $attribute->setTranslation('values', 'en', ['min' => 0, 'max' => 100, 'step' => 1]);
    $attribute->setTranslation('default_value', 'en', 50);

    $attribute->type = ['type' => 'number'];

    $attribute->save();
    $attribute->categories()->attach(1);
  }

  public function createBanners() {

    $items_en = [];
    $items_ru = [];

    $banners = Banner::all();

    foreach($banners as $key => $banner) {
      $items_en[$key]['title'] = $banner->getTranslation('title', 'en');
      $items_ru[$key]['title'] = $banner->getTranslation('title', 'ru');

      $items_en[$key]['src'] = $banner->image;
      $items_ru[$key]['src'] = $banner->image;

      $items_en[$key]['alt'] = $banner->getTranslation('short_desc', 'en');
      $items_ru[$key]['alt'] = $banner->getTranslation('short_desc', 'ru');

      $items_en[$key]['title'] = $banner->getTranslation('short_desc', 'en');
      $items_ru[$key]['title'] = $banner->getTranslation('short_desc', 'ru');

      $items_en[$key]['excerpt'] = $banner->getTranslation('short_desc', 'en');
      $items_ru[$key]['excerpt'] = $banner->getTranslation('short_desc', 'ru');

      $items_en[$key]['caption'] = $banner->getTranslation('desc', 'en');
      $items_ru[$key]['caption'] = $banner->getTranslation('desc', 'ru');

      $items_en[$key]['link'] = $banner->link;
      $items_ru[$key]['link'] = $banner->link;
    }

    $new_banner = new NewBanner;
    $new_banner->name = "MAIN BANNER";
    $new_banner->slug = "main-banner";
    $new_banner->is_active = 1;

    $new_banner->setTranslation('items', 'en', $items_en)
                ->setTranslation('items', 'ru', $items_ru);

    $new_banner->save();
  }

  public function all() {
    // $this->createCategories();
    // $this->createAttributes();
    // $this->createProducts();
    // $this->createReviews();
    // $this->createArticles();
    $this->createBanners();
  }
}

