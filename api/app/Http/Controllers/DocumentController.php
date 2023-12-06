<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Http\Resources\DocumentCollection;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entities = $this->documentService->filter();

        $entities = new DocumentCollection($entities);

        return response()->jsonApi($entities, 200);
    }

    /**
 * Store a newly created resource in storage.
     */
    public function store(DocumentRequest $request)
    {
        $entity = $this->documentService->store($request);

        if (!$entity) {
            return response()->json('Failed to create new Document', 500);
        }

        return response()->jsonApi(new DocumentResource($entity), 201);
    }

    public function show(Request $request, Document $document)
    {
        return response()->jsonApi(new DocumentResource($document), 200);
    }
}
