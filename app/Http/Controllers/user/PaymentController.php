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
        // Validate input
        $request->validate([
            'total' => 'required|numeric|min:0',
            'note' => 'required|string|max:255',
        ]);

        // Lấy thông tin từ request
        $total = $request->input('total', 0);
        $note = $request->input('note', '');
        $cart = session('cart', []);
        $user = Auth::user();

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // Lưu thông tin tạm vào session thay vì tạo đơn hàng ngay
        $tempOrderData = [
            'total' => $total,
            'note' => $note,
            'cart' => $cart,
            'user_id' => $user ? $user->id : null,
            'customer' => $user ? $user->name : 'Khách vãng lai',
            'email' => $user ? $user->email : null,
        ];
        $request->session()->put('temp_order', $tempOrderData);

        // Tạo mã tham chiếu tạm thời (có thể dùng timestamp hoặc random string)
        $vnp_TxnRef = time() . '_' . rand(1000, 9999);

        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return";
        $vnp_TmnCode = "3MN7XEF5";
        $vnp_HashSecret = "UJO8V4YOYN5B3ZBLKJK5W3EDX8Q9CPSF";

        $vnp_OrderInfo = 'Thanh toán hóa đơn #' . $vnp_TxnRef;
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
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công, lấy dữ liệu từ session và tạo đơn hàng
                $tempOrderData = $request->session()->get('temp_order');

                if (!$tempOrderData) {
                    return "Dữ liệu tạm không tồn tại!";
                }

                // Tạo đơn hàng với status = 1 (đã hoàn thành)
                $order = Order::create([
                    'customer' => $tempOrderData['customer'],
                    'email' => $tempOrderData['email'],
                    'total_amount' => $tempOrderData['total'],
                    'payment_method' => 'VNPay',
                    'status' => 0, // Đã hoàn thành
                    'note' => $tempOrderData['note'] ?: null,
                    'user_id' => $tempOrderData['user_id'],
                ]);

                // Tạo chi tiết đơn hàng
                foreach ($tempOrderData['cart'] as $gameId => $item) {
                    OrderDetail::create([
                        'unit_price' => $item['price'],
                        'game_name' => $item['name'],
                        'order_id' => $order->id,
                        'game_id' => $gameId,
                    ]);
                }

                // Xóa dữ liệu tạm và giỏ hàng
                $request->session()->forget(['temp_order', 'cart']);

                return view('user.payment_success', ['order' => $order]);
            } else {
                // Thanh toán thất bại, xóa dữ liệu tạm
                $request->session()->forget('temp_order');
                return view('user.payment_failed');
            }
        } else {
            return "Chữ ký không hợp lệ!";
        }
    }
}
