<?php

namespace App\Mail;

use App\Models\Sku;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Product;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionMessage extends Mailable
{
    use Queueable, SerializesModels;
    protected $sku;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.subscription', ['sku' => $this->sku]);
    }
}
