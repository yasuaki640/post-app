<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    private PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function post(PostCreateRequest $request): JsonResponse
    {
        $id = $this->service->create(
            $request->input('user_id'),
            $request->input('body'),
        );
        $data['id'] = $id;
        return response()->json($data, Response::HTTP_CREATED);
    }
}
