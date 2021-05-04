<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_failure_by_not_existing_user()
    {
        $req = [
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/login', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_auth_failure_no_email()
    {
        $req = [
            'password' => '12345678'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/login', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_auth_failure_no_password()
    {
        $req = [
            'email' => 'yasu@gmail.com',
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/login', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_auth_failure_wrong_credentials()
    {
        User::create([
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);

        $req = [
            'email' => 'yasu@gmail.com',
            'password' => 'wrongwrong'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/login', $req, $header);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_auth_success()
    {
        User::create([
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);

        $req = [
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/login', $req, $header);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    public function test_me_success()
    {
        $user = User::create([
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);

        $response = $this->actingAs($user)
            ->get('/api/users/me', ['Accept' => 'application/json']);

        $response->assertOk();
        $response->assertExactJson([
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
        ]);
    }
}
