<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Done
        $users = User::all();
        return self::Response(Response::HTTP_OK, 'Success', 'Data retrieved successfully.', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $user = new User();
        $user->userName = $validated['userName'];
        $user->dateOfBirth = $validated['dateOfBirth'];
        $user->email = $validated['email'];
        $user->phoneNumber = $validated['phoneNumber'];
        $user->password = $validated['password'];
        $result = $user->Save();
        if ($result !== true) {
            return self::Response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Error', 'Fialed to register a new user');
        }
        return self::Response(Response::HTTP_OK, 'Success', 'Register a new user successfully', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Done
        $user = User::find($id);
        if (!$user) {
            return self::Response(Response::HTTP_NOT_FOUND, 'Error', 'User not found');
        }
        return self::Response(Response::HTTP_OK, 'Success', 'User retrieved successfully', $user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        if (!$user) {
            return self::Response(Response::HTTP_NOT_FOUND, 'Error', 'User not found');
        }
        $user->userName = $validated['userName'];
        $user->dateOfBirth = $validated['dateOfBirth'];
        $user->email = $validated['email'];
        $user->phoneNumber = $validated['phoneNumber'];
        $user->password = $validated['password'];
        $result = $user->Save();
        if ($result !== true) {
            return self::Response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Error', 'Fialed to register a new user');
        }
        return self::Response(Response::HTTP_OK, 'Success', 'Register a new user successfully', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return self::Response(Response::HTTP_NOT_FOUND, 'Error', 'User not found');
        }
        $rslt = $user->Delete();
        if (!$rslt) {
            return self::Response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Error', 'Failed to delete user');
        }
        return self::Response(Response::HTTP_OK, 'Success', 'User deleted successfully');
    }
}
