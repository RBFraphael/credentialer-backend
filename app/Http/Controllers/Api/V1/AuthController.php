<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", [
            'except' => [
                "login", "refresh"
            ]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if(!$token = auth()->attempt($credentials)){
            return response()->json([
                'message' => __("Invalid credentials")]
            , 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        auth()->logout(true);

        return response()->json([
            'message' => __("Successfully logged out")
        ]);
    }

    public function refresh(Request $request)
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }

    public function me(Request $request)
    {
        $user = auth()->user();
        return response()->json($user);
    }

    public function update(UserUpdateRequest $request)
    {
        $user = User::find(auth()->user()->id);
        if($user){
            $user->name = $request->input("name", $user->name);
            $user->email = $request->input("email", $user->email);
            $user->password = $request->input("password", $user->password);
            $user->save();

            return response()->json($user);
        }

        return response()->json([
            'message' => __("User not found")
        ], 404);
    }

    protected function respondWithToken($token)
    {
        $user = auth()->setToken($token)->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }
}
