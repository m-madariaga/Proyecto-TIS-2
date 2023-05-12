<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class statusChangeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $status;
    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $status, $id)
    {
        $this->name = $name;
        $this->status = $status;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.status_changed')->with([
            "name" => $this->name,
            "status" => $this->status,
            "id" => $this->id

        ]);
    }
}
