<?php

namespace Tests\Feature;

use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DocumentShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_document_successfully(): void
    {
        $document = Document::factory()->create();
        $response = $this->getJson(route('documents.show', ['document' => $document]));

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('data.id', $document->id)
                ->etc()
        );
    }

    public function test_view_non_existing_document_returns_404(): void
    {
        $response = $this->getJson(route('documents.show', ['document' => 9999999]));

        $response->assertStatus(404);
    }
}
