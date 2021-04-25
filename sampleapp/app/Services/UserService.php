<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\User;
use App\Repository\Impl\UserRepositoryImpl;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;

class UserService
{
    private UserRepository $repo;

    #[Pure] public function __construct(UserRepositoryImpl $repo)
    {
        $this->repo = $repo;
    }

    public function store(array $req): int
    {
        return $this->repo->store($req);
    }

    public function findById(int $id): ?User
    {
        return $this->repo->findById($id);
    }

    public function findAll(): Collection|array
    {
        return $this->repo->findAll();
    }

    public function update(array $req): void
    {
        $this->repo->update($req);
    }

    public function destroy(int $id): void
    {
        $this->repo->destroy($id);
    }
}
