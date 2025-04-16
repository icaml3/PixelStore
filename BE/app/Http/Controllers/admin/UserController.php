<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Validator;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tất cả User
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $users = User::with('orders')->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Danh sách người dùng',
            'data' => UserResource::collection($users),
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
            ]
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    //Chi tiết người dùng
    public function show(string $id)
    {
        $user = User::with('orders')->find($id);

        if (is_null($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Người dùng không tồn tại',
                'data' => []
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Chi tiết người dùng',
            'data' => new UserResource($user)
        ], 200);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Người dùng không tồn tại',
                'data' => []
            ], 404);
        }
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'role' => 'nullable|in:0,1',
            'status' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors(),
            ], 422);
        }
        $user->status = $input['status'] ?? $user->status;
        $user->role = $input['role'] ?? $user->role;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật người dùng thành công',
            'data' => new UserResource($user)
        ], 200);
    }

    public function destroy(string $id)
    {
        //
    }
}
