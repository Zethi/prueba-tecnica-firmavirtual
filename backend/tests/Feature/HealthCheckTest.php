<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{

    public function test_the_health_check_returns_a_successful_response(): void
    {
        $response = $this->get('/api/healthcheck');

        $response->assertStatus(200);
    }
}
