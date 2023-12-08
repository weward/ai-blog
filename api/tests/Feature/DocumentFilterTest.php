<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DocumentFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_list_documents(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->getJson(route('documents.index'));

        $response->assertStatus(200);
    }

}
