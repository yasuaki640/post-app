<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\Post;
use App\Repository\PostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    private PostRepository $repo;

    public function __construct()
    {
        $this->repo = new PostRepository();
    }

    public function create(int $user_id, string $body): int
    {
        $id = $this->repo->create($user_id, $body);
        return $id;
    }

    public function findAll(): Collection
    {
        $posts = $this->repo->findAll();
        return $posts;
    }

    public function update(int $id, string $body): Post
    {
        $post = $this->repo->update($id, $body);
        return $post;
    }
}
