<?php
namespace App\Http\View\Composers;


use Illuminate\View\View;

class CommonComposer
{
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
/*
        $languages_ul = \Cache::get('languages_ul', function() {
	          $languages = array_diff_key(config('backpack.crud.locales'), config('backpack.crud.executed_locales'));
			  $current_language = '';
			
			  //return '';
							  
			  return (string)\View::make('langs', [
  				'languages' => $languages, 
  				'current_language' => $current_language
			  ])->render();
        });
*/
        
        //dd($languages_ul);
/*
$languages = array_diff_key(config('backpack.crud.locales'), config('backpack.crud.executed_locales'));
			  $current_language = '';
          $languages_ul = view('includes.languages', [
  				'languages' => $languages, 
  				'current_language' => $current_language
			  ])->render();
*/
		$languages_ul = '';	  
        $view->with('languages_ul', $languages_ul);
    }
}