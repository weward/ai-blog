<?php

namespace App\Services;

// use OpenAI\Laravel\Facades\OpenAI;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ChatGptService
{
    protected $retries = 3;

    public function generateArticle($request, $type='summary')
    {
        $prompt = config('prompts.article');

        $inputField = $this->getInputField($type);

        $messages[] = $prompt[$type]; // system
        $messages[] = [
            'role' => 'user',
            'content' => $request->{$inputField},
        ];

        $result = $this->getResult($messages);

        return $result;
    }

    public function getResult($messages)
    {
        try {
            $apiUrl = config('openai.api_url');
            $apiKey = config('openai.api_key');
            $apiTimeout = config('openai.request_timeout');

            $response = Http::retry(3, 34000, function(Exception $e, PendingRequest $request) {
                return $e instanceof RequestException;
            })
            ->timeout($apiTimeout)
            ->connectTimeout($apiTimeout)
            ->acceptJson()
            ->withToken($apiKey)
            ->post($apiUrl, [
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
            ])?->json();

            return $response['choices'][0]['message']['content'] ?? '';
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function getInputField($type)
    {
        $match = match($type) {
            'summary' => 'subject', // to get summary, provide $request->subject in $messages
            'bullets' => 'subject',
            'result' => 'bullets',
            default   => 'subject'
        };

        return $match;
    }

}
