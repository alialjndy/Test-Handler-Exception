<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService ;
    public function __construct(UserService $userService){
        $this->userService = $userService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->createUser($data);
        return response()->json([
            'status'=>'success',
            'message'=>$user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->showUserById($id);
        return response()->json([
            'data'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
