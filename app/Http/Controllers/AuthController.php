<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected function Register(StoreUserRequest $request) {
        $validated = $request->validated();
        $user = new User();
        $user->userName = $validated['userName'];
        $user->dateOfBirth = $validated['dateOfBirth'];
        $user->email = $validated['email'];
        $user->phoneNumber = $validated['phoneNumber'];
        $user->password = bcrypt($validated['password']);
        $result = $user->Save();
        if ($result !== true) {
            return self::Response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Error', 'Fialed to register a new user');
        }
        $token = $user->createToken('@123#')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        return self::Response(Response::HTTP_OK, 'Success', 'Register a new user successfully', $data);
    }

    protected function Login(LoginUserRequest $request) {
        $validated = $request->validated();
        $user = User::where('userName', $validated['userName'])->first();
        $message = "Logged in successfully.";
        $title = "Success";
        if (!$user) {
            return self::Response(Response::HTTP_NOT_FOUND, 'Failed', 'User name not found.');
        }
        if (!Hash::check($validated['password'], $user->password)) {
            return self::Response(Response::HTTP_UNAUTHORIZED, 'Failed', 'Invalid password.');
        }
        $token = $user->createToken('@123#')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        return self::Response(Response::HTTP_OK, 'Success', 'Logged in successfully', $data);
    }

    protected function Logout(Request $request) {
        auth()->user()->tokens()->delete();
        return self::Response(Response::HTTP_OK, 'Success', 'You are logged out!');
    }
}
