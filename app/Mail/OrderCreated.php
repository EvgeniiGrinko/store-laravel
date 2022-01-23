<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;


class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $order; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, Order $order)
    {
        $this->name = $name;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fullSum = $this->order->getFullSum();
        return $this->view('mail.order_created', ['name' => $this->name, 'fullSum' => $fullSum, 'order' => $this->order]);
    }
}
