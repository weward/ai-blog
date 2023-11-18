<?php

namespace App\Services;

use App\Models\Document;

class DocumentService {

    public function filter()
    {
        $documents = Document::query()->paginate();

        return $documents;
    }

    public function store($request) {
        $document = Document::create([
            'keyword' => $request->keyword,
            'summary' => $request->summary,
            'bullets' => $request->bullets,
            'results' => $request->results,
        ]);

        return $document;
    }


}
