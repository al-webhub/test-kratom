<?php

return [
  'enable_bonus_system' => true,
  'enable_referral_system' => true,
  'referral_levels' => 3,
  'referral_bonuses' => [10, 5, 2], // bonus % for each level. Last value affects all levels after it
  'enable_cashback' => true,
  'cashback_value' => 1, // cashback %

  // PROFILE MODEL
  'profile_model' => 'App\Models\Override\Profile',

  // ORDER
  'order_model' => 'Backpack\Store\app\Models\Order',

  // REVIEW
  'review_model' => 'Backpack\Reviews\app\Models\Review',

  // RESOURCES
  'full_resource' => 'App\Http\Resources\ProfileFullResource',

  'tiny_resource' => 'Backpack\Profile\app\Http\Resources\ProfileTinyResource',

  'reset_password_redirect' => env('FRONT_URL') . '/'
];
