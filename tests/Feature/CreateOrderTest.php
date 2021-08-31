<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    public function test_creating_order()
    {
        $response = $this->postJson('/api/create_order', ['name' => 'First order', 'country_code' => 'de', 'proxies_ordered' => 12]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
