<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\User;

class UserRepository
{
    public function create(string $name, string $email, string $password): int
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ])->id;
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}
