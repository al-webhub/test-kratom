<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Buy1ClickCreatedAdmin extends Mailable
{
    use Queueable, SerializesModels;
	
	  public $feedback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown('mail.feedback_created_admin')
                  ->with([
                    'feedback' => $this->feedback,
                    'product' => $this->feedback->extras['product'] ?? null,
                  ]);
    }
}
