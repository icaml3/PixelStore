<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->product_id;
        $productName = is_array($request->product_name) ? implode(', ', $request->product_name) : $request->product_name;
        $productPrice = floatval($request->product_price);
        $productImage = $request->product_image;
        $quantity = intval($request->quantity);

        $cart[$productId] = [
                'name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
            ];

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');}

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        return view('user.cart', compact('cart', 'total'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
