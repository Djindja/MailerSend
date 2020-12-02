<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Email;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    /**
     * display contact form
     *
     * @return view
     */
    public function index()
    {
        return view('send_email');
    }

    /**
     * list emails
     *
     * @return view
     */
    public function list()
    {
        return view('list_emails');
    }

    /**
     * get email by id
     *
     * @return json
     */
    public function getById(int $id)
    {
        $email = Email::where('id', $id)->first();
        return Response::json($email);
    }

    /**
     * get emails in json
     *
     * @return json
     */
    public function jsonEmails()
    {
        $emails = Email::all();

        return Response::json($emails);
    }

    /**
     * send email to user
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'emailFrom' => 'required|email',
            'emailTo' => 'required|email',
            'subject' => 'required',
            'textContent' => 'required',
            'htmlMessage' => 'required',
            'attachment' => 'required',
        ]);

        $data = array(
            'emailFrom' => $request->emailFrom,
            'emailTo' => $request->emailTo,
            'subject' => $request->subject,
            'textContent' => $request->textContent,
            'htmlMessage' => $request->htmlMessage,
        );

        $email = new Email();
        $email->emailFrom = $request->emailFrom;
        $email->emailTo = $request->emailTo;
        $email->subject = $request->subject;
        $email->textContent = $request->textContent;
        $email->htmlMessage = $request->htmlMessage;
        $email->status = 'sent';


        if($request->hasFile('attachment')){
            $files = $request->file('attachment');

            foreach ($files as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $file->storeAs('/attachments', $fileNameToStore);
                $pathTo = Storage::disk('public')->path($path);

                $email->attachment = $pathTo;

                $data['attachment'][] = $email->attachment;
            }
        }

        $result = Mail::to($request->emailTo)->send(new SendMail($data));

        if (!empty($result)) {
            $email->status = 'failed';
            return new Error(Mail::failures());
        }

        $email->save();

        return redirect('/mails');
    }
}