<?php

namespace App\Observers;

use Illuminate\Support\Facades\Mail;

use \App\Models\Override\Order;
use Backpack\Transactions\app\Models\Transaction;

use \App\Mail\OrderCreated;
use \App\Mail\OrderCreatedAdmin;


class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {

      // SEND NOTY TO ADMIN EMAIL
      Mail::to(env('ADMIN_MAIL', 'info@kratomhelper.com'))->queue(new OrderCreatedAdmin($order));  

      // SEND NOTY TO CUSTOMER
      $email = $order->user->email ?? null;
      $email = $email? $email: ($order->info['user']['email'] ?? null);

      if($email)
        Mail::to($email)->queue(new OrderCreated($order));
      
      // CREATE TRANSACTIONS
      if(!$order->user)
        return;

      $this->createCashbackTransactions($order);
      $this->createReferralTransactions($order);
      $this->createBonusesUsedTransactions($order);
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
      // if(!$order->user || !in_array($order->status, ['sent', 'paid', 'delivered']))
      //   return;

      // $this->createCashbackTransactions($order);
      // $this->createReferralTransactions($order);
    } 

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }


    public function createReferralTransactions($order) {
      $referrer = $order->user;
      $bonuses = [10, 5, 2];

      for($i = 0; $i < 3; $i++) {
        $referrer = $referrer->referrer;

        if(!$referrer)
          return;

        $percent = $bonuses[$i]? $bonuses[$i] : $bonuses[count($bonuses - 1)];
        $value = $order->price * $percent / 100;

        Transaction::create([
          'owner_id' => $referrer->id,
          'value' => $value,
          'currency' => 'USD',
          'description' => $percent . '% bonus from level ' . ($i + 1) . ' referral',
          'type' => 'bonus',
          'status' => 'complited',
        ]);
          
        //$referrer->notify(new ReferralBonus($transaction));
      }
    }

    public function createCashbackTransactions($order) {
      
      $cashback = $order->price * 0.01;

      $data = [
        'owner_id' => $order->user->id,
        'value' => $cashback,
        'currency' => 'USD',
        'description' => $cashback . '% cashback from order ' . $order->code,
        'type' => 'cashback',
        'status' => 'complited',
      ];

      $order->createTransaction($data);
      
      //$order->user->notify(new CashbackBonus($transaction));
    }

    public function createBonusesUsedTransactions($order) {
      
      if(!isset($order->info['bonusesUsed']) || !$order->info['bonusesUsed'])
        return;

      $bonuses = $order->info['bonusesUsed'];

      $data = [
        'owner_id' => $order->user->id,
        'value' => $bonuses * -1,
        'currency' => 'USD',
        'description' => '$' . $bonuses . ' bonuses were used to pay for the order ' . $order->code,
        'type' => 'bonusesUsed',
        'status' => 'complited',
      ];

      $order->createTransaction($data);
    }
}
