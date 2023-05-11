<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(UserCreateRequest $request)
    {
        $user = new User([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => $request->input("password"),
            'role' => $request->input("role"),
        ]);
        $user->save();

        return response()->json($user);
    }

    public function all(Request $request)
    {
        $with = $request->get("with", []);
        $where = $request->only(["role"]);
        $users = User::where($where)->with($with)->get();
        return response()->json($users);
    }

    public function get(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $with = $request->get("with", []);
            $user = User::with($with)->find($id);
            if($user){
                return response()->json($user);
            }

            return response()->json([
                'message' => __("User not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing user ID")
        ], 422);
    }

    public function update(UserUpdateRequest $request, $id = null)
    {
        if(is_numeric($id)){
            $user = User::find($id);
            if($user){
                $user->name = $request->input("name", $user->name);
                $user->email = $request->input("email", $user->email);
                $user->password = $request->input("password", $user->password);
                $user->role = $request->input("role", $user->role);
                $user->save();

                return response()->json($user);
            }

            return response()->json([
                'message' => __("User not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing user ID")
        ], 422);
    }

    public function delete(Request $request, $id = null)
    {
        if(is_numeric($id)){
            $user = User::find($id);
            if($user){
                $user->delete();

                return response()->json([
                    'message' => __("User deleted successfully")
                ]);
            }

            return response()->json([
                'message' => __("User not found")
            ], 404);
        }

        return response()->json([
            'message' => __("Invalid or missing user ID")
        ], 422);
    }
}
