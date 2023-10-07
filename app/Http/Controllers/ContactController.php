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
        $content = $message->validated('message');
        if ($content == cache('last_contact_form_message') || $this->spamChecker->isContactFormContentSpam($content, app()->getLocale())) {
            logger()->info('SPAM DETECTED - ' . json_encode($message, JSON_PRETTY_PRINT));
            return redirect()->back()->with('message', __('contact.spam_message'));
        }

        $recipient->notify(new ContactFormMessage($message));

        cache(['last_contact_form_message' => $content], now()->addMinutes(10));

        return redirect()->back()->with('message', __('contact.success_message'));
    }
}
