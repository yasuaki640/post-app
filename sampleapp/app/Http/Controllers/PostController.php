<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function post(PostUpdateRequest $request): JsonResponse
    {
        $id = $this->service->create(
            $request->input('user_id'),
            $request->input('body'),
        );
        $data['id'] = $id;
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function list(Request $request): JsonResponse
    {
        $posts = $this->service->findAll();

        $data['posts'] = $posts;
        return response()->json($data, Response::HTTP_OK);
    }

    public function update(PostUpdateRequest $request): JsonResponse
    {
        $post = $this->service->update(
            $request->input('id'),
            $request->input('body'),
        );

        $data['post'] = $post;
        return response()->json($data, Response::HTTP_OK);
    }
}
