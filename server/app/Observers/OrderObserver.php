<?php

namespace App\Observers;

use \App\Models\Override\Order;
use Backpack\Transactions\app\Models\Transaction;

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
      if(!$order->user)
        return;

      $this->createCashbackTransactions($order);
      $this->createReferralTransactions($order);
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
}
