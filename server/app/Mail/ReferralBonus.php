<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralBonus extends Mailable
{
    use Queueable, SerializesModels;
	
	  public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->subject('You received referral bonus / KRATOMHELPER')
                    ->markdown('mail.referral_bonus')
                    ->with([
                      'transaction' => $this->transaction,
                    ]);
    }
}
