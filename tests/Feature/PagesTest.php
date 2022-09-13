<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    /**
     * @return void
     */
    public function testHomePage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
