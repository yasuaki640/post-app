<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
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
        $users = $this->service->findAll();

        return \response()->json(UserResource::collection($users), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $id = $this->service->store($request->all());
        return \response()->json(['id' => $id], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function show(DeleteRequest $request): JsonResponse
    {
        $id = intval($request->user_id);
        $user = $this->service->findById($id);

        return \response()->json(UserResource::make($user), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $this->service->update($request->toArray());
        return \response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteRequest $request): JsonResponse
    {
        $id = intval($request->user_id);
        $this->service->destroy($id);
        return \response()->json([], Response::HTTP_NO_CONTENT);
    }
}
