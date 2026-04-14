# LAPTOP SHOP - Website quản lý bán laptop

Bài tập lớn xây dựng bằng **Laravel 8** + **MySQL** + **Bootstrap 5**.

## Tính năng

### Frontend
- Trang chủ với sản phẩm nổi bật, sản phẩm mới, danh mục, hãng
- Danh sách sản phẩm với tìm kiếm, lọc (hãng/danh mục/giá), sắp xếp
- Chi tiết sản phẩm với cấu hình đầy đủ (CPU, RAM, GPU...)
- Giỏ hàng (session-based)
- Thanh toán (COD, chuyển khoản, VNPay, Momo)
- Đăng ký, đăng nhập

### Admin
- Dashboard với biểu đồ doanh thu 7 ngày
- CRUD sản phẩm với cấu hình laptop chi tiết
- Quản lý danh mục, hãng sản xuất
- Quản lý đơn hàng (xem chi tiết, cập nhật trạng thái)

## Hướng dẫn chạy

### Yêu cầu
- XAMPP (Apache + MySQL khởi động)
- PHP 7.4+ với Composer

### Bước 1: Cấu hình DB (đã có sẵn `.env`)
- Database: `laptop_shop`
- Username: `root`
- Password: (rỗng)

### Bước 2: Khởi tạo database
```bash
php artisan migrate:fresh --seed
```

### Bước 3: Chạy server
```bash
php artisan serve
```
Mở: http://127.0.0.1:8000

## Tài khoản mẫu

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@laptopshop.com | admin123 |
| Khách hàng | customer@gmail.com | 123456 |

## URL chính

- `/` - Trang chủ
- `/products` - Danh sách laptop
- `/product/{slug}` - Chi tiết sản phẩm
- `/cart` - Giỏ hàng
- `/checkout` - Thanh toán
- `/admin` - Trang quản trị (cần đăng nhập admin)
