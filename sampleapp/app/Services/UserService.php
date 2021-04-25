<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;

class UserService
{
    private UserRepository $repo;

    #[Pure] public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param array $params
     * @return int User id
     */
    public function store(array $params): int
    {
        return $this->repo->store(
            $params['name'],
            $params['email'],
            $params['password']
        );
    }

    public function findById(int $id): ?User
    {
        return $this->repo->findById($id);
    }

    public function findAll(): Collection|array
    {
        return $this->repo->findAll();
    }

    public function update(array $req)
    {
        $this->repo->update($req);
    }
}
