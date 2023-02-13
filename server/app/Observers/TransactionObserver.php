<?php

namespace App\Observers;

use Illuminate\Support\Facades\Mail;

use \Backpack\Transactions\app\Models\Transaction;

use App\Mail\CashbackBonus;
use App\Mail\ReferralBonus;
use App\Mail\WithdrawalCompleted;
use App\Mail\ReviewBonus;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
      $email = $transaction->owner->email;

      if($transaction->type === 'withdrawal'){
        Mail::to($email)->queue(new WithdrawalCompleted($transaction));
      }elseif($transaction->type === 'cashback') {
        Mail::to($email)->queue(new CashbackBonus($transaction));
      }elseif($transaction->type === 'review') {
        Mail::to($email)->queue(new ReviewBonus($transaction));
      }elseif($transaction->type === 'bonus') {
        Mail::to($email)->queue(new ReferralBonus($transaction));
      }
    }
}
