<?php

namespace App\Services\Mocks;

use App\Services\Interfaces\ContactFormSpamCheckerInterface;

class ContactFormSpamCheckerMock implements ContactFormSpamCheckerInterface
{
    /**
     * @param string $content
     * @param string $locale
     * @return bool|null
     */
    public function isContactFormContentSpam(string $content, string $locale): bool|null
    {
        return boolval(rand(0, 1));
    }
}
