# PixelStore - Website Bán Game

## Giới Thiệu

**PixelStore** là một website thương mại điện tử được xây dựng bằng **Laravel**, cho phép người dùng mua các tựa game trực tuyến. Dự án cung cấp các tính năng như đăng nhập/đăng ký, xác thực email, quản lý giỏ hàng, và hiển thị danh sách game với thông tin chi tiết (giá, giảm giá, mô tả, hình ảnh, v.v.). Website được thiết kế với giao diện thân thiện, dễ sử dụng, và hỗ trợ cả người dùng thông thường và quản trị viên.

---

## Tính Năng Chính

- **Đăng Nhập/Đăng Ký:** Người dùng có thể tạo tài khoản, đăng nhập, và xác thực email trước khi sử dụng dịch vụ.
- **Xác Thực Email:** Gửi email xác thực tùy chỉnh với logo và giao diện chuyên nghiệp của PixelStore.
- **Quản Lý Giỏ Hàng:** Người dùng có thể thêm/xóa game vào giỏ hàng và thực hiện thanh toán.
- **Danh Sách Game:** Hiển thị danh sách game với thông tin chi tiết (tên, giá, giảm giá, hình ảnh, video, mô tả, v.v.).
  - Tên game được giới hạn trong một dòng với dấu ba chấm (`...`) nếu quá dài.
  - Giá game hiển thị với định dạng tiền tệ (VNĐ), và trạng thái "Mới" được in màu đỏ.
- **Quản Trị Viên:** Quản trị viên có thể quản lý danh sách game, người dùng, và đơn hàng.
- **Dữ Liệu Mẫu:** Cung cấp dữ liệu mẫu với 12 tựa game nổi bật.

---

## Công Nghệ Sử Dụng

- **Backend:** Laravel 10.x (PHP 8.x)
- **Frontend:** Blade Templates, CSS, JavaScript
- **Cơ Sở Dữ Liệu:** MySQL
- **Gửi Email:** Laravel Mail (hỗ trợ SMTP, ví dụ: Gmail)
- **Công Cụ Khác:**
  - Composer (quản lý thư viện PHP)
  - Artisan (công cụ dòng lệnh của Laravel)

---

## Cài Đặt

### Yêu Cầu Hệ Thống
- PHP >= 8.0
- Composer
- MySQL hoặc cơ sở dữ liệu tương thích với Laravel
- Node.js và npm (nếu sử dụng các thư viện JavaScript)
- Một dịch vụ SMTP để gửi email (ví dụ: Gmail)

### Hướng Dẫn Cài Đặt

1. **Clone Dự Án**
   ```bash
   git clone https://github.com/your-username/pixelstore.git
   cd pixelstore
   
2. **Cài Đặt Thư Viện**
   ```bash
   composer install
    npm install
   
3. **Sao Chép File Cấu Hình**
Sao chép file .env.example thành .env:
   ```bash
   copy .env.example .env
   
4. **Tạo Khóa Ứng Dụng**
   ```bash
   php artisan key:generate
   
5. **Cấu Hình Cơ Sở Dữ Liệu**
Mở file .env và cập nhật thông tin cơ sở dữ liệu:
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pixelstore
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
   
6. **Cấu Hình Gửi Email**
Cập nhật thông tin SMTP trong file .env:
   ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your-email@gmail.com
    MAIL_PASSWORD=your-app-password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your-email@gmail.com
    MAIL_FROM_NAME="PixelStore"
Lưu Ý: Nếu sử dụng Gmail, bạn cần tạo App Password từ tài khoản Google và sử dụng nó thay cho mật khẩu thông thường.

7. **Chạy Migration**
Chạy migration để tạo bảng trong cơ sở dữ liệu:
   ```bash
    php artisan migrate

8. **Khởi Động Server**
   ```bash
   php artisan serve
Truy cập ứng dụng tại: http://localhost:8000.

##    Cách Sử Dụng
Đăng Ký Tài Khoản
Truy cập http://localhost:8000/register để đăng ký tài khoản.
Sau khi đăng ký, bạn sẽ nhận được email xác thực từ PixelStore.
Nhấn vào nút "Xác Thực Email Ngay" trong email để kích hoạt tài khoản.
Đăng Nhập
Truy cập http://localhost:8000/login để đăng nhập.
Sau khi đăng nhập, bạn có thể xem danh sách game và thêm game vào giỏ hàng.
Quản Lý Giỏ Hàng
Thêm game vào giỏ hàng bằng cách nhấn nút "Thêm vào giỏ hàng".
Xóa game khỏi giỏ hàng bằng cách nhấn nút "x".
Quản Trị Viên
Đăng nhập bằng tài khoản quản trị viên (có role = 1) để truy cập trang quản trị (/admin).

##    Tác Giả
- **Tên:** Nguyễn Hải Lâm
- **Email:** 9hailam.nh@gmail.com
- **GitHub:** https://github.com/icaml3
