<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        // Lấy thông tin từ request
        $total = $request->input('total', 0);
        $cart = session('cart', []);
        $user = Auth::user();

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        $order = Order::create([
            'customer' => $user ? $user->name : 'Khách vãng lai',
            'email' => $user ? $user->email : null,
            'total_amount' => $total,
            'payment_method' => 'VNPay',
            'discount' => 0, // Có thể thêm logic tính discount nếu cần
            'user_id' => $user ? $user->id : null,
        ]);

        foreach ($cart as $gameId => $item) {
            OrderDetail::create([
                'unit_price' => $item['price'],
                'game_name' => $item['name'],
                'order_id' => $order->id,
                'game_id' => $gameId,
            ]);
        }

        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return";
        $vnp_TmnCode = "3MN7XEF5";
        $vnp_HashSecret = "UJO8V4YOYN5B3ZBLKJK5W3EDX8Q9CPSF";

        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = 'Thanh toán hóa đơn #' . $order->id;
        $vnp_OrderType = 'PixelStore';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $request->ip();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if ($vnp_HashSecret) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Chuyển hướng tới URL thanh toán VNPay
        return redirect()->away($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        // Xử lý phản hồi từ VNPay
        $vnp_HashSecret = "UJO8V4YOYN5B3ZBLKJK5W3EDX8Q9CPSF";
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash === $vnp_SecureHash) {
            $orderId = $inputData['vnp_TxnRef'];
            $order = Order::with('orderDetails')->find($orderId);

            if (!$order) {
                return "Đơn hàng không tồn tại!";
            }

            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công, xóa giỏ hàng
                $request->session()->forget('cart');
                return view('user.payment_success', ['order' => $order]);
            } else {
                // Thanh toán thất bại, xóa đơn hàng và chi tiết đơn hàng
                $order->orderDetails()->delete();
                $order->delete();
                return view('user.payment_failed', ['order' => $order]);
            }
        } else {
            return "Chữ ký không hợp lệ!";
        }
    }
}
