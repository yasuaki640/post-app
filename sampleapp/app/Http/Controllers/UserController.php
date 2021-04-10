<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Pure;

class UserController extends Controller
{
    private UserService $service;

    #[Pure] public function __construct(UserService $service)
    {
        $this->service = new UserService();
    }

    public function register(UserRegistRequest $req): JsonResponse
    {
        $req->input('name');
        return response()->json('fuck');
    }
}
