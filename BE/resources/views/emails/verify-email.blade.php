@component('mail::message')
Xác Thực Email Của Bạn

Xin chào **{{ $user->full_name }}**,

Cảm ơn bạn đã đăng ký tài khoản tại **PixelStore**!
Để tiếp tục sử dụng dịch vụ, vui lòng xác thực địa chỉ email của bạn bằng cách nhấn vào nút bên dưới:

@component('mail::button', ['url' => $url, 'color' => 'success'])
Xác Thực Email Ngay
@endcomponent

<i>Nếu bạn không đăng ký tài khoản này, vui lòng bỏ qua email này hoặc liên hệ với chúng tôi qua email: **support@pixelstore.com**.</i>

**Lưu ý:** Liên kết xác thực sẽ hết hạn sau 60 phút.

Trân trọng,
Đội ngũ PixelStore
[www.pixelstore.com](https://www.pixelstore.com)
@endcomponent
