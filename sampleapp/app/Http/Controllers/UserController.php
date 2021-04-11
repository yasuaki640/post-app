<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JetBrains\PhpStorm\Pure;

class UserController extends Controller
{
    private UserService $service;

    #[Pure] public function __construct()
    {
        $this->service = new UserService();
    }

    public function register(UserRegisterRequest $req): JsonResponse
    {
        $id = $this->service->register(
            $req->input('name'),
            $req->input('email'),
            $req->input('password')
        );
        return response()->json($id,Response::HTTP_CREATED);
    }
}
