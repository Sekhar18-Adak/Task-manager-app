<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
        public $message;
        public $subject;
    /**
     * Create a new message instance.
     */
    public function __construct($subject,$message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    

    // }
        //here we dont use content public function beacuse content() is already defined inside Laravel's Mailable class. and for every msg we should built every blade file which is not valuable practices.
        
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.test')
                    ->with(['emailMessage' => $this->message]);
    }
    
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

}
