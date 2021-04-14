<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_getById_validation_failed()
    {
        $response = $this->get('/api/user/1aa');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
