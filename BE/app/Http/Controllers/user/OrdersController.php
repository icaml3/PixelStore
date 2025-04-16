<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('orderDetails.game')
            ->latest()
            ->paginate(10);
        $data = [
            'orders' => $orders,
        ];
        return view('user.orders', $data);
    }

    public function show($id)
    {
        $order = auth()->user()->orders()
            ->with('orderDetails.game')
            ->findOrFail($id);
        $data = [
            'order' => $order,
        ];
        return view('user.ordersdetail', $data);
    }
}
