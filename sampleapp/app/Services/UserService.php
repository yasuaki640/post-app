<?php
declare(strict_types=1);

namespace App\Services;


use App\Models\User;
use App\Repository\UserRepository;
use JetBrains\PhpStorm\Pure;

class UserService
{
    private UserRepository $repo;

    #[Pure] public function __construct()
    {
        $this->repo = new UserRepository;
    }

    public function register(string $name, string $email, string $password): int
    {
        $id = $this->repo->create($name, $email, $password);
        return $id;
    }

    public function findById(int $id): ?User
    {
        return $this->repo->findById($id);
    }
}
