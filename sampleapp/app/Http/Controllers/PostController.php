<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Post\DeleteRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $request->merge(['user_id' => auth()->id()]);
    }

    /**
     * Display the specified resource.
     *
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function show(DeleteRequest $request): JsonResponse
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteRequest $request): JsonResponse
    {
    }
}
