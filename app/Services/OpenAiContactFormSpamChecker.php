<?php

namespace App\Services;

use App\Services\Interfaces\ContactFormSpamCheckerInterface;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAiContactFormSpamChecker implements ContactFormSpamCheckerInterface
{
    public function isContactFormContentSpam(string $content, string $locale): bool|null
    {
        $messages = [
            ['role' => 'system', 'content' => config('services.ai.openai.roles.system.locale.' . $locale . '.spam_checker', 'You are spamCheckerGPT - A ChatGPT clone with speciality in checking contact form content for spam. You reply with either "true" if the content is spam or "false" if it\'s not')],
        ];

        $messages[] = ['role' => 'user', 'content' => $content];

        $model = config('services.ai.openai.model');

        logger()->info('Sent to ' . $model . ' :' . json_encode($messages, JSON_PRETTY_PRINT));

        $response = OpenAI::chat()->create([
            'model' => $model,
            'messages' => $messages,
        ]);

        logger()->info('Received from ' . $model . ' :' . json_encode($response, JSON_PRETTY_PRINT));

        $content = $response->choices[0]->message->content;

        return !empty($content) ? boolval($content) : null;
    }
}
