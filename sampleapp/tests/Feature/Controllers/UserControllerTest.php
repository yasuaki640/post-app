<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
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

    public function test_create_validation_failure_email_already_taken()
    {
        User::create([
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);

        $response = $this->post('/api/users', [
            'name' => 'tako',
            'email' => 'yasu@gmail.com',
            'password' => '87654321'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_success()
    {
        $response = $this->post('/api/users', [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
        ]);
    }

    public function test_index_failure_auth_failure()
    {
        $response = $this->getJson('/api/users');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
