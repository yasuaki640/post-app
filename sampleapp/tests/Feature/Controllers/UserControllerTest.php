<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_create_validation_failure()
    {
        $response = $this->post('/api/users', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
