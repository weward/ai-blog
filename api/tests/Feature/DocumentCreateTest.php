<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_document(): void
    {
        $response = $this->postJson(route('documents.store'), [
            'keyword' => 'This is a sample keyword. Give meaning to it.',
            'summary' => 'This is the summary containing all that is there about the keyword.',
            'bullets' => '- keyword\\n- Another keyword\\n- test',
            'results' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ]);

        $response->assertStatus(201);
    }

    public function test_storing_invalid_document_fails(): void
    {
        $response = $this->postJson(route('documents.store'), [
            'keyword' => 'a',
            'summary' => 's',
            'bullets' => 'd',
            'results' => 'f',
        ]);

        $response->assertInvalid([
            'keyword',
            'summary',
            'bullets',
            'results',
        ]);
    }
}
