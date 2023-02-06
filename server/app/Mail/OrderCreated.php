<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;
	
	  public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $bonuses_used = $this->order->transactions->where('type', 'bonuses_used')->first();
      $bonuses_used = $bonuses_used? $bonuses_used->change: 0;
      
        return $this->subject('New order created / KRATOMHELPER')
                    ->markdown('mail.order_created')
                    ->with([
                      'order' => $this->order,
                      'user' => $this->order->info['user'] ?? null,
                      'products' => $this->order->info['products'] ?? null,
                      'address' => $this->order->info['address'] ?? null,
                      'bonuses_used' => $bonuses_used
                    ]);
    }
}
