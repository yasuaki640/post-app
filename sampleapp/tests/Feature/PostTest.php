<?php
declare(strict_types=1);

namespace Tests\Feature;

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

    //public function test_index_success()
    //{
    //    $user = User::factory()->count(3)->create();
    //
    //    $response = $this->actingAs($user)
    //        ->get('/api/posts', ['Accept' => 'application/json']);
    //
    //    $response->assertOk();
    //    $response->assertExactJson(Po);
    //}
}