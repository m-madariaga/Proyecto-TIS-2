<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProofPayment extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $asunto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$asuntin)
    {
        $this->order = Order::find($id);
        $this->asunto = $asuntin;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('receipt.ticket_correo', ['order' => $this->order])
            ->subject($this->asunto)
            ->attach(public_path('/assets/images/logo_1.png'), ['as' => 'logo_1.png', 'mime' => 'image/png']);
    }
}