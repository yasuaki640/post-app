<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\ShowRequest;
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
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request): JsonResponse
    {
        $id = intval($request->user_id);
        $user = $this->service->findById($id);

        return \response()->json(UserResource::make($user), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @return JsonResponse
     */
    public function edit(EditRequest $request)
    {
        $this->service->update($request->toArray());
        return \response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
