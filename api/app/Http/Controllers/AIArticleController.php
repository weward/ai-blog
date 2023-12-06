<?php

namespace App\Http\Controllers;

use App\Http\Resources\AIArticleResource;
use App\Services\ChatGptService;
use Illuminate\Http\Request;

class AIArticleController extends Controller
{
    protected $service;

    public function __construct(ChatGptService $service)
    {
        $this->service = $service;
    }

    public function generatePlot(Request $request)
    {
        $summary = $this->service->generateArticle($request, 'summary');
        $bullets = $this->service->generateArticle($request, 'bullets');

        $result = [
            'summary' => $summary,
            'bullets' => $bullets,
        ];

        $httpStatus = $summary && $bullets ? 200 : 500;

        return response()->jsonApi($result, $httpStatus);
    }

    public function generateResult(Request $request)
    {
        $result = $this->service->generateArticle($request, 'result');

        $httpStatus = $result ? 200 : 500;

        return response()->jsonApi($result, $httpStatus);
    }

}
