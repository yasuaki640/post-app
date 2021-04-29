<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_validation_failure_password_of_7_chars()
    {
        $req = [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/users', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_validation_failure_email_wrong_format()
    {
        $req = [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/users', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_validation_failure_email_already_taken()
    {
        User::create([
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ]);

        $req = [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/users', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_success()
    {
        $req = [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '12345678'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->post('/api/users', $req, $header);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
        ]);
    }

    public function test_index_failure_auth_failure()
    {
        $response = $this->getJson('/api/users', ['Accept' => 'application/json']);
        $response->assertUnauthorized();
    }

    public function test_index_success()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->actingAs($users->first())
            ->get('/api/users', ['Accept' => 'application/json']);

        $response->assertOk();
        $response->assertExactJson(UserResource::collection($users)->jsonSerialize());
    }

    public function test_show_failure_id_has_string()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/users/1e', ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_show_success()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/users/' . $user->id, ['Accept' => 'application/json']);

        $response->assertOk();

        $expected = UserResource::make($user)->jsonSerialize();
        $response->assertExactJson($expected);
    }

    public function test_update_failure_no_id()
    {
        $user = User::factory()->create();

        $req = [
            'name' => 'yasu',
            'email' => 'yasu@gmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/users/me', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_failure_empty_name()
    {
        $user = User::factory()->create();

        $req = [
            'id' => $user->id,
            'name' => '',
            'email' => 'yasu@gmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/users/me', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_failure_invalid_mail_format()
    {
        $user = User::factory()->create();

        $req = [
            'id' => $user->id,
            'name' => 'yasu',
            'email' => 'yasugmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/users/me', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_failure_invalid_password()
    {
        $user = User::factory()->create();

        $req = [
            'id' => $user->id,
            'name' => 'yasu',
            'email' => 'yasugmail.com',
            'password' => '1234567'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/users/me', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_success()
    {
        $user = User::factory()->create();

        $req = [
            'name' => 'yasu',
            'email' => 'y640@gmail.com',
            'password' => '12345678'
        ];

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/users/me', $req, $header);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'yasu',
            'email' => 'y640@gmail.com',
        ]);
    }

    public function test_destroy_failure_auth_failure()
    {
        $response = $this->deleteJson('/api/users/me', [], ['Accept' => 'application/json']);
        $response->assertUnauthorized();
    }

    public function test_destroy_success()
    {
        $user = User::factory()->create();

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->delete('/api/users/me', [], $header);

        $response->assertNoContent();
        $this->assertSoftDeleted($user);
    }

}
