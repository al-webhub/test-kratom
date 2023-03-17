<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;

use App\Models\Product;
use Backpack\NewsCRUD\app\Models\Article;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $langs_array = array_keys(array_diff_key(config('backpack.crud.locales'), config('backpack.crud.executed_locales')));
        $langs_array = array_map(function($lang){
            if($lang != 'en_US')
                return  strtolower(str_replace('_', '-', $lang));

            return '';
        },$langs_array);
        
        //dd($langs_array);

        foreach($langs_array as $lang) {
            $sitemap = Sitemap::create();

            $sitemap->add(Url::create(url($lang . '/'))
                    ->setChangeFrequency('daily')
                    ->setPriority(1));
    
            $pages = ['shop', 'shop/other-products', 'rewards', 'pay_delivery', 'reviews', 'contacts', 'about_us', 'guidebook', 'faq', ];
    
            foreach($pages as $page) {
                $sitemap->add(Url::create(url($lang . '/' . $page))
                        ->setChangeFrequency('daily')
                        ->setPriority(0.8));
            }
    
            $products = Product::get();
    
            foreach($products as $product) {
                $sitemap->add(Url::create(url($lang . '/' . $product->slug))
                        ->setChangeFrequency('daily')
                        ->setPriority(0.6));
            }
			
			switch($lang){
				case 'ru-kz':
					$abbr = 'ru_KZ';
				break;
				case 'en-gh':
					$abbr = 'en_GH';
				break;
				default:
					$abbr = 'en';
			}
			
			
            $articles = Article::withoutGlobalScopes()->where('language_abbr', $abbr)->get();
			
/*
			if($abbr == 'ru_KZ')
				dd($articles->count());	
*/
			
            foreach($articles as $article) {
                $sitemap->add(Url::create(url($lang . '/guidebook/' . $article->slug))
                        ->setChangeFrequency('daily')
                        ->setPriority(0.6));
            }
            
            $path = $lang? "/sitemap-$lang.xml" : "/sitemap.xml";

            $sitemap->writeToFile(public_path($path));
        }
    }
}
