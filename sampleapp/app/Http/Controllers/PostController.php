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

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @var PostService
     */
    private PostService $service;

    /**
     * PostController constructor.
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = $this->service->findAll();
        return response()->json(PostResource::collection($posts), Response::HTTP_OK);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $request->merge(['user_id' => auth()->id()]);

        $id = $this->service->store($request->toArray());

        return response()->json(['id' => $id], Response::HTTP_CREATED);
    }

    /**
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request): JsonResponse
    {
        $post = $this->service->findById(intval($request->post_id));

        return response()->json(PostResource::make($post), Response::HTTP_OK);
    }

    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        if ($request->user()->cannot('update', Post::find($request->id))) {
            return response()->json(['message' => 'You do not own this post.'], Response::HTTP_FORBIDDEN);
        }
        $request->merge(['user_id' => auth()->id()]);
        $this->service->update($request->toArray());

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteRequest $request): JsonResponse
    {
        if ($request->user()->cannot('destroy', Post::find($request->post_id))) {
            return response()->json(['message' => 'You do not own this post.'], Response::HTTP_FORBIDDEN);
        }
        $this->service->destroy(intval($request->post_id));

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
