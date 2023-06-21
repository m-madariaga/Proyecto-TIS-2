<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProofPayment extends Mailable
{
    use Queueable, SerializesModels;
    protected $users,$date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuarios,$fecha)
    {
        $this->users = $usuarios;
        $this->date = $fecha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('receipt.ticket_correo',['order' => $this->order])->attach(public_path('\assets\images\logo_1.png'),['as' => 'logo_1.png','mime' => 'image/png']);
    }
}
