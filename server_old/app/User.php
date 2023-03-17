<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// implements MustVerifyEmail
class User extends Authenticatable
{
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'referrer_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['usermeta'];
    
	public function toArray(){
		return [
			'id' => $this->id,
			'login' => $this->name,
			'email' => $this->email,
			'usermeta' => $this->usermeta
		];
	}

    public function usermeta() {
        return $this->hasOne('Aimix\Account\app\Models\Usermeta');
    }

    public function orders() {
        return $this->hasManyThrough('Aimix\Shop\app\Models\Order', 'Aimix\Account\app\Models\Usermeta');
    }

    public function referrer(){
        return $this->belongsTo('Aimix\Account\app\Models\Usermeta', 'referrer_id', 'id');
    }
  
    public function referrals(){
        return $this->usermeta->hasMany('Aimix\Account\app\Models\Usermeta', 'referrer_id', 'id');
    }

    public function transactions(){
        return $this->hasManyThrough('Aimix\Account\app\Models\Transaction', 'Aimix\Account\app\Models\Usermeta')->orderBy('created_at', 'desc');
    }
		
    public function getReferrerIdAttribute(){
        return $this->usermeta->referrer_id;
    }

    public function getReferralCodeAttribute(){
        return $this->usermeta->referral_code;
    }

}
