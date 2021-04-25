<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function store(array $req): int;

    public function findById(int $id): ?User;

    public function findAll(): Collection;

    public function update(array $req): void;

    public function destroy(int $id): void;
}
