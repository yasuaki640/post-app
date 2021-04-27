<?php
declare(strict_types=1);

namespace App\Repository\Impl;


use App\Models\Post;
use App\Repository\PostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostRepositoryImpl implements PostRepository
{

    public function store(array $req): int
    {
        return Post::create([
            'user_id' => $req['user_id'],
            'body' => $req['body']
        ])->id;
    }

    public function findById(int $id): ?Post
    {
        return Post::find($id);
    }

    public function findAll(): Collection
    {
        return Post::all();
    }

    public function update(array $req): void
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $id): void
    {
        // TODO: Implement destroy() method.
    }
}
