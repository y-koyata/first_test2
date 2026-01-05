<?php

namespace Tests\Feature;

use Tests\TestCase;

class HelloTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_hello_page_returns_a_successful_response(): void
    {
        $response = $this->get('/hello');

        $response->assertStatus(200);
        $response->assertSee('Hello World!');
    }
}
