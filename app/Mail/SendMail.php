<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $e = $this->from($this->data['emailFrom'])
            ->subject('New Member')
            ->view('email_template')
            ->with('data', $this->data);

            foreach ($this->data['attachment'] as $a) {
                $e->attach($a);
            };

        return $e;

    }
}
