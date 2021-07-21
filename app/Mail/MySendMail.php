<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MySendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $student_detail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student_detail)
    {
        $this->student_detail = $student_detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Eduance')

        ->view('emails.mySendMail');
    }
}
?>
