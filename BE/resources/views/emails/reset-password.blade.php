<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            /* text-align: center; */
            padding: 20px 0;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
            /* text-align: center; */
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            border-radius: 5px;
            margin: 20px 0;
        }
        a{
            color: #ffffff;
            text-decoration: none;
        }
        .footer {
            /* text-align: center; */
            padding: 20px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Chào bạn,</h2>
            <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu từ tài khoản của bạn tại PixelStore.</p>
            <p>Nhấn vào nút bên dưới để tiến hành đặt lại mật khẩu:</p>
            <a href="{{ $url }}" class="button">Tạo Mật Khẩu Mới</a>
            <p>Liên kết này sẽ hết hạn sau 30 phút.</p>
            <p>Nếu bạn không gửi yêu cầu này, vui lòng liên hệ với chúng tôi qua email <a href="mailto:support@pixelstore.com">support@pixelstore.com</a> để được hỗ trợ.</p>
        </div>
        <div class="footer">
            <p>Cảm ơn bạn đã sử dụng PixelStore!</p>
            <p>Hỗ trợ khách hàng PixelStore</p>
            <p>© {{ date('Y') }} PixelStore. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</body>
</html>
