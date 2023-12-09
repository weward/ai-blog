<?php

namespace App\Services;

use App\Models\Document;

class DocumentService
{
    public function filter()
    {
        $documents = Document::query()
            ->filter()
            ->orderBy('id', 'DESC')
            ->paginate(request()->rowsPerPage);

        return $documents;
    }

    public function store($request)
    {
        try {
            $document = Document::create([
                'user_id' => auth()->user()->id,
                'subject' => $request->subject,
                'summary' => $request->summary,
                'bullets' => $request->bullets,
                'result' => nl2br($request->result),
            ]);

            return $document;
        } catch(\Throwable $th) {
            return false;
        }
    }

}
