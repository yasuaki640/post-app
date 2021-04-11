<?php


namespace App\Repository;


use App\Models\Post;

class PostRepository
{
    public function create($user_id, $body): int
    {
        return Post::create([
            'user_id' => $user_id,
            'body' => $body,
        ])->id;
    }
}
