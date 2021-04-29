<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Post\DeleteRequest;
use App\Http\Requests\Post\ShowRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $posts = $this->service->findAll();
        return response()->json(PostResource::collection($posts), Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $request->merge(['user_id' => auth()->id()]);

        $id = $this->service->store($request->toArray());

        return response()->json(['id' => $id], Response::HTTP_CREATED);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $post = $this->service->findById(intval($request->post_id));

        return response()->json(PostResource::make($post), Response::HTTP_OK);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $request->merge(['user_id' => auth()->id()]);
        $this->service->update($request->toArray());

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function destroy(DeleteRequest $request): JsonResponse
    {
        if ($request->user()->cannot('destroy', Post::find($request->post_id))) {
            abort(403);
        }
        $this->service->destroy(intval($request->post_id));

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
