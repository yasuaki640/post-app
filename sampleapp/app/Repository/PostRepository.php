<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepository
{
    public function store(array $req): int;

    public function findById(int $id): ?Post;

    public function findAll(): Collection;

    public function update(array $req): void;

    public function destroy(int $id): void;
}
