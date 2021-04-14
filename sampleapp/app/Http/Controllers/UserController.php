<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\GetByIdRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private UserService $service;

    #[Pure] public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $req): JsonResponse
    {
        $id = $this->service->register(
            $req->input('name'),
            $req->input('email'),
            $req->input('password'),
        );
        $data['id'] = $id;
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function getById(GetByIdRequest $request, int $id): JsonResponse
    {
        $user = $this->service->findById($id);
        if (is_null($user)) {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        $data['user'] = $user;
        return response()->json($data, Response::HTTP_CREATED);
    }
}
