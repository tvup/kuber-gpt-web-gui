<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Recipient;
use App\Notifications\ContactFormMessage;
use App\Services\Interfaces\ContactFormSpamCheckerInterface;

class ContactController extends Controller
{
    public function __construct(private ContactFormSpamCheckerInterface $spamChecker)
    {
    }

    public function show()
    {
        return view('landing-pages.contact');
    }

    public function mailContactForm(ContactFormRequest $message, Recipient $recipient)
    {
        if ($this->spamChecker->isContactFormContentSpam($message->validated('message'), app()->getLocale())) {
            return redirect()->back()->with('message', __('contact.spam_message'));
        }

        $recipient->notify(new ContactFormMessage($message));

        return redirect()->back()->with('message', __('contact.success_message'));
    }
}
