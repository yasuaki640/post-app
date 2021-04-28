<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_validation_failure_empty_body()
    {
        $user = User::factory()->create();

        $req = ['body' => ''];
        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->post('/api/posts', $req, $header);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_store_success()
    {
        $user = User::factory()->create();

        $req = ['body' => 'Hello world!!!'];
        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->post('/api/posts', $req, $header);

        $response->assertCreated();
        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'body' => 'Hello world!!!',
        ]);
    }

    public function test_index_success()
    {
        $user = User::factory()->create();
        $posts = Post::factory()->count(3)->create();

        $response = $this->actingAs($user)
            ->get('/api/posts', ['Accept' => 'application/json']);

        $response->assertOk();

        $expected = PostResource::collection($posts)->jsonSerialize();
        $response->assertExactJson($expected);
    }

    public function test_show_failure_validation_failure_string_id()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/posts/1e2e', ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_show_success()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/posts/' . $post->id, ['Accept' => 'application/json']);

        $response->assertOk();

        $expected = PostResource::make($post)->jsonSerialize();
        $response->assertExactJson($expected);
    }

    public function test_update_failure_validation_failure_no_id()
    {
        $user = User::factory()->create();

        $req = ['body' => 'Hello world!!!!'];
        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/posts', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_failure_validation_failure_not_existing_id()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $req = [
            'id' => 99999999999,
            'user_id' => $post->user_id,
            'body' => 'Hello world!!!'
        ];
        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/posts', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_failure_validation_failure_no_body()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $req = [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'body' => ''
        ];
        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/posts', $req, $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_update_success()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $req = [
            'id' => $post->id,
            'body' => 'fixed!!!'
        ];
        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->put('/api/posts', $req, $header);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'body' => 'fixed!!!'
        ]);
    }

    public function test_destroy_failure_validation_failure_id_has_string()
    {
        $user = User::factory()->create();
        Post::factory()->create();

        $header = ['Accept' => 'application/json'];

        $response = $this->actingAs($user)
            ->delete('/api/posts/1e', [], $header);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
