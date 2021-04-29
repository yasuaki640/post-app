<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->findAll();

        return \response()->json(UserResource::collection($users), Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $id = $this->service->store($request->all());
        return \response()->json(['id' => $id], Response::HTTP_CREATED);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $id = intval($request->user_id);
        $user = $this->service->findById($id);

        return \response()->json(UserResource::make($user), Response::HTTP_OK);
    }

    public function update(UpdateRequest $request)
    {
        $this->service->update($request->toArray());
        return \response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function destroy(DeleteRequest $request): JsonResponse
    {
        $id = intval($request->user_id);
        $this->service->destroy($id);
        return \response()->json([], Response::HTTP_NO_CONTENT);
    }
}
