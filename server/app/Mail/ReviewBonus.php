<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewBonus extends Mailable
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
        return $this->subject('You received a bonus for your review / KRATOMHELPER')
                    ->markdown('mail.review_bonus')
                    ->with([
                      'transaction' => $this->transaction,
                    ]);
    }
}
