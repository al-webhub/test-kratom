<?php

namespace App\Models\Override;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Backpack\Transactions\app\Traits\HasTransactions;

use Backpack\Profile\app\Models\Profile as BaseProfile;

class Profile extends BaseProfile
{
  use HasTransactions;
   // use HasApiTokens, Notifiable;

  public function getBalanceDataAttribute() {
    return [
      'balance' => $this->getBalance(),
      'review' => $this->getBalanceByType('review'),
      'bonus' => $this->getBalanceByType('bonus'),
      'cashback' => $this->getBalanceByType('cashback'),
      'debit' => $this->getDebit(),
    ];
  }

  public static $fields = [
    'firstname' => [
      'rules' => 'required|string|min:2|max:255'
    ],
    
    'lastname' => [
      'rules' => 'nullable|string|min:2|max:255'
    ],
    
    'phone' => [
      'rules' => 'nullable|string|min:2|max:255'
    ],

    'addresses.*' => [
      'rules' => 'array:country,city,state,street,apartment,zip,comment,is_default',
      'country' => [
        'rules' => 'nullable|string|min:2|max:255',
        'store_in' => 'addresses'
      ],
      'city' => [
        'rules' => 'nullable|string|min:2|max:255',
        'store_in' => 'addresses'
      ],
      'state' => [
        'rules' => 'nullable|string|min:2|max:255',
        'store_in' => 'addresses'
      ],
      'street' => [
        'rules' => 'nullable|string|min:2|max:255',
        'store_in' => 'addresses'
      ],
      'apartment' => [
        'rules' => 'nullable|string|min:1|max:255',
        'store_in' => 'addresses'
      ],
      'zip' => [
        'rules' => 'nullable|string|min:6|max:255',
        'store_in' => 'addresses',
      ],
      'comment' => [
        'rules' => 'nullable|string|min:6|max:255',
        'store_in' => 'addresses',
      ],
      'is_default' => [
        'rules' => 'nullable|string|min:6|max:255',
        'store_in' => 'addresses',
      ],
    ],
    
    'communication' => [
      'rules' => 'required|in:Telegram,Whatsapp,Skype,Viber,Facebook,Instagram',
      'store_in' => 'extras'
    ],

    'communication_number' => [
      'rules' => 'required|string|min:2|max:255',
      'store_in' => 'extras'
    ]
  ];
}
