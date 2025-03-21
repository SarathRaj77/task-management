<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UserDto;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Filesystem\ServeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(
        protected UserService $user_service
    ) {}


    public function register(RegisterRequest $request)
    {
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ];
        $dto = UserDto::build($data);
        $user = $this->user_service->create($dto);
        $token = $user->createToken('api-token')->plainTextToken;
        return $this->success('Regstered Successfully', ['user' => $user, 'token' => $token]);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->user_service->findBy('email', $request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return $this->success('user login success', ['user' => new UserResource($user), 'token' => $token]);
    }
}
