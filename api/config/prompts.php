<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chat Completion
    |--------------------------------------------------------------------------
    |
    | This serves as the default prompt for chat completions - article type
    */
    'article' => [
        'summary' => [
            'role' => 'system',
            'content' => 'I will provide a subject for an article. Provide me with a short summarized paragraph about it. here is the subject:'
        ],

        'bullets' => [
            'role' => 'system',
            'content' => 'Give four chapter titles in bullet-point format for this topic:'
        ],

        'result' => [
            'role' => 'system',
            'content' => 'Create content for each of the following bullet points:',
        ]
    ],

];
