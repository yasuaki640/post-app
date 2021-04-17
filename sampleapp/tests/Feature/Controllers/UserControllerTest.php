<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_validation_failure_password_of_7_chars()
    {
        $response = $this->post('/api/users', [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '1234567'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_validation_failure_email_wrong_format()
    {
        $response = $this->post('/api/users', [
            'name' => 'yasu',
            'email' => 'yasugmail.com',
            'password' => '1234567'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_success()
    {
        $response = $this->post('/api/users', [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);


        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
