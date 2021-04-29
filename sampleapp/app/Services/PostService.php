<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\Post;
use App\Repository\Impl\PostRepositoryImpl;
use App\Repository\PostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    private PostRepository $repo;

    public function __construct(PostRepositoryImpl $repo)
    {
        $this->repo = $repo;
    }

    public function create(int $user_id, string $body): int
    {
        return $this->repo->create($user_id, $body);
    }

    public function findAll(): Collection|array
    {
        return $this->repo->findAll();
    }

    public function update(array $req): void
    {
        $this->repo->update($req);
    }

    public function store(array $req): int
    {
        return $this->repo->store($req);
    }

    public function findById(int $id): ?Post
    {
        return $this->repo->findById($id);
    }

    public function destroy(int $id)
    {
        $this->repo->destroy($id);
    }
}
