<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Email;

class EmailController extends Controller
{
    public function test()
    {
        return 'hello';
    }

    public function index()
    {
        return view('send_email');
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'emailFrom' => 'required|email',
            'emailTo' => 'required|email',
            'subject' => 'required'
        ]);

        $data = array(
            'message' => $request->message
        );

        $email = new Email();
        $email->emailFrom = $request->emailFrom;
        $email->emailTo = $request->emailTo;
        $email->subject = $request->subject;
        $email->textContent = $request->textContent;
        $email->htmlMessage = $request->htmlMessage;
        $email->attachment = $request->attachment;
        $email->save();

        Mail::to($request->emailTo)->send(new SendMail($data));

        return back()->with('success', 'Thanks for contacting us!');
    }
}