<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $Transaction;
    public $PaymentType;
    public function __construct($Transaction, $PaymentType)
    {
        $this->Transaction = $Transaction;

        $this->PaymentType = $PaymentType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->$Transaction);
        return $this->subject('Mail from Al_Aqsa_Association')
                    ->view('emails.myTestMail');
    }
}
