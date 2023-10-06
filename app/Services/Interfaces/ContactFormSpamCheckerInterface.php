<?php

namespace App\Services\Interfaces;

interface ContactFormSpamCheckerInterface
{
    /**
     * @param string $content The content to evaluate
     * @param string $locale The locale chosen
     * @return bool|null Returns either a boolean (is spam?) or null in case of error
     */
    public function isContactFormContentSpam(string $content, string $locale) : bool|null;
}
