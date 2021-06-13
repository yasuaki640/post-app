<?php
declare(strict_types=1);

namespace App\Repository\Impl;


use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImpl implements UserRepository
{
    public function store(array $req): int
    {
        return User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => \Hash::make($req['password']),
        ])->id;
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findAll(): Collection
    {
        return User::all();
    }

    public function update(array $req): void
    {
        User::find($req['id'])
            ->fill($req)
            ->save();
    }

    public function destroy(int $id): void
    {
        User::find($id)->delete();
    }
}
