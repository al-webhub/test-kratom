<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
      'info' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function products()
    {
      return $this->belongsToMany('\Aimix\Shop\app\Models\Product');
    }
    
    public function modifications()
    {
      return $this->belongsToMany('App\Models\Modification')->withPivot('amount');
    }
    
    public function delivery()
    {
      return $this->belongsTo('Aimix\Shop\app\Models\Delivery');
    }
    
    public function payment()
    {
      return $this->belongsTo('Aimix\Shop\app\Models\Payment');
    }

    public function usermeta()
    {
      return $this->belongsTo('Aimix\Account\app\Models\Usermeta');
    }
    
    public function transactions() {
      return $this->hasMany('Aimix\Account\app\Models\Transaction');
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
    public function getStatusStringAttribute(){
	    if($this->status == 'new' || $this->status == 'pending' || $this->status == 'paid' || $this->status == 'sent')
	    	return '<span class="icon-sent order-history-icon"></span><span class="text">'.$this->status.'</span>';
	    elseif($this->status == 'canceled')
	    	return '<span class="icon-canceled order-history-icon"></span><span class="text" style="color: #EB5757;">CANCELED</span>';
	    else
	    	return '<span class="icon-delivered order-history-icon"></span><span class="text" style="color: #ACDA53;">delivered</span>';
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
