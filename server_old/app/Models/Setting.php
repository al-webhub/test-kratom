<?php

namespace App\Models;

use Backpack\Settings\app\Models\Setting as BaseSetting;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Config;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Setting extends BaseSetting
{
    use CrudTrait;

    protected $table = 'settings';
    protected $fillable = ['value', 'key', 'name', 'field', 'active', 'language_abbr'];
	//protected $translatable = ['field'];

	protected static function boot()
    {
        parent::boot();
	    $language = session()->has('lang')? session()->get('lang'): 'ru';
	    //dd($language);
        static::addGlobalScope('language', function (Builder $builder) use ($language) {
            $builder->where(function($q) use ($language) {
                $q->whereRaw('LOWER(`language_abbr`) = ?', str_replace('-', '_', $language))
                  ->orWhereRaw('LOWER(`language_abbr`) = ?', explode('-', $language)[0])
                  ->orWhereRaw('LOWER(`language_abbr`) = ?', 'en_us');
            });
        });
    }
/*
    
    public static function get($key)
    {
		    
	}
*/
}
