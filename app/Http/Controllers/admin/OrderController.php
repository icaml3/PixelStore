<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use Validator;
use App\Http\Resources\Order as OrderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tất cả Order
    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'status' => true,
            'message' => 'Danh sách đơn hàng',
            'data' => OrderResource::collection($orders)
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

    // Chi tiết đơn hàng
    public function show(string $id)
    {
        $orders = Order::findOrFail($id);
        if (is_null($orders)) {
            return response()->json([
                'success' => false,
                'message' => 'Không có đơn hàng này',
                'data' => []
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Chi tiết đơn hàng',
            'data' => new OrderResource($orders)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    // Cập nhật đơn hàng
    public function update(Request $request, string $id)
    {
        $orders = Order::find($id);
        if (is_null($orders)) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng không tồn tại',
                'data' => []
            ], 404);
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'status' => 'nullable||in:0,1',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 422);
        }
        $orders->status = $input['status'] ?? $orders->status;
        $orders->save();
        return response()->json([
            'status' => true,
            'message' => 'Đơn hàng đã cập nhật thành công',
            'data' => new OrderResource($orders)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
