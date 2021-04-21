<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
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

    public function test_index_success()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->actingAs($users->first())
            ->get('/api/users')
            ->assertStatus(Response::HTTP_OK);

        $response->assertExactJson($users->toArray());
    }

    public function test_show_failure_id_has_string()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/users/1e');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson($user);
    }

    public function test_destroy_failure_auth_failure()
    {
        $response = $this->deleteJson('/api/users/1');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
