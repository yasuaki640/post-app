<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function store(array $req): int
    {
        return User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => $req['password'],
        ])->id;
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findAll(): Collection|array
    {
        return User::all();
    }

    public function update(array $req): void
    {
        User::find($req['id'])
            ->fill([
                'name' => $req['name'],
                'email' => $req['email'],
                'password' => $req['password'],
            ])->save();
    }

    public function destroy(int $id): void
    {
        User::find($id)->delete();
    }
}
