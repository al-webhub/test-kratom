<?php

namespace Aimix\Banner\app\Models;

use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Banner extends Model
{
    use CrudTrait;
    use HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'banners';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected $translatable = ['title', 'desc', 'short_desc'];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function toArray(){
	    return [
		    'title' => $this->title,
		    'desc' => $this->desc,
		    'short_desc' => $this->short_desc,
		    'link' => url($this->link),
		    'image' => url(str_replace('uploads', 'glide', $this->image) . '?h=262&w=1423&fm=pjpg&q=55'),
		    'badImage' => url(str_replace('uploads', 'glide', $this->image) . '?h=262&w=1423&fm=pjpg&q=5'),
	    ];
    }
    
    protected static function boot()
    {
         parent::boot();
        $language = session()->has('lang')? session()->get('lang'): 'ru';
        
        if(config('aimix.aimix.enable_languages')) {
            static::addGlobalScope('language', function (Builder $builder) use ($language) {
                $builder->where('language_abbr', $language);
            });
        }
    }
    
    public function clearGlobalScopes()
    {
        static::$globalScopes = [];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
