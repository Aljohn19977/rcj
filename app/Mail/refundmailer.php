<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Purifier;

class refundmailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->view('user_ui.refundemailer_send',['msg'=>Purifier::clean($request->reply),'email'=>Purifier::clean($request->email),'name'=>Purifier::clean($request->name)])->to($request->email)->subject('RCJ Fashion Customer Support.');
}
}
