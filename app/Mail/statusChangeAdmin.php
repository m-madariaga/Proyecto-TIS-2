<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class statusChangeAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $status;
    public $id;
    public $traceability;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $status, $id, $traceability)
    {
        $this->name = $name;
        $this->status = $status;
        $this->id = $id;
        $this->traceability = $traceability;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.status_changed_admin')->with([
            "name" => $this->name,
            "status" => $this->status,
            "id" => $this->id,
            "traceability" => $this->traceability

        ]);
    }
}
