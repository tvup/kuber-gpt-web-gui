<?php
namespace App\Http\Controllers;

use App\Notifications\ContactFormMessage;
use App\Http\Requests\ContactFormRequest;
use App\Models\Recipient;
class ContactController extends Controller
{
    public function show()
    {
        return view('landing-pages.contact');
    }
    public function mailContactForm(ContactFormRequest $message, Recipient $recipient)
    {
        $recipient->notify(new ContactFormMessage($message));

        return redirect()->back()->with('message', __('contact.success_message'));
    }
}