<?php
declare(strict_types=1);

namespace App\Services;


use App\Repository\PostRepository;

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
}
