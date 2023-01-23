<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'reviews';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
	
	protected $with = ['user'];
	
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function toArray()
    {
      return [
        "id" => $this->id,
        "is_moderated" => $this->is_moderated,
        "type" => $this->type,
        "name" => $this->name,
        "email" => $this->email,
        "category" => $this->category,
        "product_id" => $this->product_id,
        "children" => $this->children,
        "rating" => $this->rating,
        "likes" => $this->likes,
        "dislikes" => $this->dislikes,
        "file" => $this->file,
        "text" => $this->text,
        "photo" => url($this->photo),
        "created_at" => \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans()
      ];
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }
    
    public function children()
    {
      return $this->hasMany('App\Models\Review', 'parent_id');
    }
    
    public function product()
    {
      return $this->belongsTo('App\Models\Product');
    }
    
    public function transaction() {
      return $this->hasOne('App\Models\Transaction');
    }

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
	public function getPhotoAttribute(){
		
/*
		if(is_object($this->user->usermeta->photo))
			dd($this->user->usermeta->photo);
*/
		
		if($this->name == 'Incognito')
			return url('/img/incognito.png');
	
		if($this->user && $this->user->usermeta && $this->user->usermeta->photo)
			return url($this->user->usermeta->photo);
		
		if($this->file)
			return url($this->file);
		else
			return url('/img/profile.png');	
	}
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
