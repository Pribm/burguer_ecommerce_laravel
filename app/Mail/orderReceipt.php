<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Auth\User;
use App\Models\Order;

class orderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $orderId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, int $orderId)
    {
        $this->user = $user;
        $this->orderId = $orderId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = Order::where('id',$this->orderId)->with(['users', 'products', 'address'])->first();

        $this->from('admin@example.com', 'oi');
        $this->to('	abcd@xyz.com');

        return $this->view('mails.orderReceipt', ['order' => $order]);

    }
}
