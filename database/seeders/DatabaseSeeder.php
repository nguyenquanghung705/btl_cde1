<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ===== USERS =====
        User::create([
            'name' => 'Admin',
            'email' => 'admin@laptopshop.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '0900000001',
        ]);

        User::create([
            'name' => 'Khách Hàng Demo',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'customer',
            'phone' => '0900000002',
        ]);

        // ===== BRANDS =====
        $brands = ['Dell', 'HP', 'Asus', 'Acer', 'MSI', 'Lenovo', 'Apple'];
        foreach ($brands as $name) {
            Brand::create(['name' => $name]);
        }

        // ===== CATEGORIES =====
        // 1: Gaming, 2: Văn phòng, 3: Đồ họa, 4: Sinh viên
        $cats = [
            'Laptop Gaming' => 'Laptop chuyên game, hiệu năng cao',
            'Laptop Văn phòng' => 'Mỏng nhẹ, pin trâu, phù hợp công việc',
            'Laptop Đồ họa' => 'Card đồ họa rời mạnh, RAM lớn',
            'Laptop Sinh viên' => 'Giá hợp lý, đáp ứng nhu cầu học tập',
        ];
        foreach ($cats as $name => $desc) {
            Category::create(['name' => $name, 'description' => $desc]);
        }

        // ===== PRODUCTS ===== (22 products)
        // brand ids: 1=Dell, 2=HP, 3=Asus, 4=Acer, 5=MSI, 6=Lenovo, 7=Apple
        $img = fn($slug) => '/images/products/' . $slug . '.svg';

        $products = [
            [
                'name' => 'Dell XPS 13 Plus 9320',
                'category_id' => 2, 'brand_id' => 1, 'model' => '9320',
                'cpu' => 'Intel Core i7-1260P', 'ram' => '16GB LPDDR5',
                'storage' => '512GB SSD NVMe', 'gpu' => 'Intel Iris Xe',
                'screen' => '13.4" OLED 3.5K', 'os' => 'Windows 11',
                'weight' => 1.24, 'battery' => '55Wh',
                'price' => 42990000, 'sale_price' => 38990000,
                'stock' => 15, 'warranty' => '24 tháng',
                'image' => $img('dell-xps-13-plus'),
                'description' => "Thiết kế siêu mỏng, viền màn hình cực mỏng, phím InvisiPad độc đáo.\nMàn hình OLED 3.5K cho màu sắc rực rỡ, hỗ trợ cảm ứng.",
                'is_featured' => 1, 'is_new' => 1,
            ],
            [
                'name' => 'Dell Inspiron 15 3520',
                'category_id' => 4, 'brand_id' => 1, 'model' => '3520',
                'cpu' => 'Intel Core i5-1335U', 'ram' => '16GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '15.6" FHD', 'os' => 'Windows 11',
                'weight' => 1.65, 'battery' => '41Wh',
                'price' => 17990000, 'sale_price' => 15990000,
                'stock' => 22, 'warranty' => '12 tháng',
                'image' => $img('dell-inspiron-15'),
                'is_featured' => 1,
            ],
            [
                'name' => 'Dell Latitude 5430',
                'category_id' => 2, 'brand_id' => 1, 'model' => '5430',
                'cpu' => 'Intel Core i7-1255U', 'ram' => '16GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '14" FHD IPS', 'os' => 'Windows 11 Pro',
                'weight' => 1.36, 'battery' => '58Wh',
                'price' => 24990000,
                'stock' => 10, 'warranty' => '36 tháng',
                'image' => $img('dell-latitude-5430'),
            ],
            [
                'name' => 'Dell G15 5530 Gaming',
                'category_id' => 1, 'brand_id' => 1, 'model' => '5530',
                'cpu' => 'Intel Core i7-13650HX', 'ram' => '16GB DDR5',
                'storage' => '1TB SSD', 'gpu' => 'NVIDIA RTX 4050 6GB',
                'screen' => '15.6" FHD 120Hz', 'os' => 'Windows 11',
                'weight' => 2.65, 'battery' => '86Wh',
                'price' => 28990000, 'sale_price' => 25990000,
                'stock' => 14, 'warranty' => '24 tháng',
                'image' => $img('dell-g15-5530'),
                'is_new' => 1,
            ],
            [
                'name' => 'HP Pavilion 15-eg3094TU',
                'category_id' => 4, 'brand_id' => 2, 'model' => '15-eg3094TU',
                'cpu' => 'Intel Core i5-1335U', 'ram' => '8GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '15.6" FHD IPS', 'os' => 'Windows 11',
                'weight' => 1.75, 'battery' => '41Wh',
                'price' => 18990000, 'sale_price' => 16990000,
                'stock' => 25, 'warranty' => '12 tháng',
                'image' => $img('hp-pavilion-15'),
                'is_featured' => 1,
            ],
            [
                'name' => 'HP Envy x360 2-in-1',
                'category_id' => 3, 'brand_id' => 2, 'model' => '13-bf',
                'cpu' => 'Intel Core i7-1355U', 'ram' => '16GB LPDDR5',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '13.3" 2.8K OLED cảm ứng', 'os' => 'Windows 11',
                'weight' => 1.37, 'battery' => '66Wh',
                'price' => 29990000, 'sale_price' => 27990000,
                'stock' => 8, 'warranty' => '12 tháng',
                'image' => $img('hp-envy-x360'),
                'is_featured' => 1, 'is_new' => 1,
            ],
            [
                'name' => 'HP Victus 16 Gaming',
                'category_id' => 1, 'brand_id' => 2, 'model' => '16-r',
                'cpu' => 'Intel Core i7-13700HX', 'ram' => '16GB DDR5',
                'storage' => '512GB SSD', 'gpu' => 'NVIDIA RTX 4060 8GB',
                'screen' => '16.1" FHD 144Hz', 'os' => 'Windows 11',
                'weight' => 2.37, 'battery' => '70Wh',
                'price' => 32990000, 'sale_price' => 29990000,
                'stock' => 11, 'warranty' => '24 tháng',
                'image' => $img('hp-victus-16'),
                'is_new' => 1,
            ],
            [
                'name' => 'Asus ROG Strix G16 G614JV',
                'category_id' => 1, 'brand_id' => 3, 'model' => 'G614JV',
                'cpu' => 'Intel Core i7-13650HX', 'ram' => '16GB DDR5',
                'storage' => '512GB SSD', 'gpu' => 'NVIDIA RTX 4060 8GB',
                'screen' => '16" FHD+ 165Hz', 'os' => 'Windows 11',
                'weight' => 2.50, 'battery' => '90Wh',
                'price' => 39990000, 'sale_price' => 36990000,
                'stock' => 10, 'warranty' => '24 tháng',
                'image' => $img('asus-rog-strix-g16'),
                'is_featured' => 1,
            ],
            [
                'name' => 'Asus ZenBook 14 OLED UX3402',
                'category_id' => 3, 'brand_id' => 3, 'model' => 'UX3402',
                'cpu' => 'Intel Core i7-1260P', 'ram' => '16GB LPDDR5',
                'storage' => '1TB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '14" 2.8K OLED 90Hz', 'os' => 'Windows 11',
                'weight' => 1.39, 'battery' => '75Wh',
                'price' => 31990000, 'sale_price' => 29990000,
                'stock' => 8, 'warranty' => '24 tháng',
                'image' => $img('asus-zenbook-14-oled'),
                'is_new' => 1,
            ],
            [
                'name' => 'Asus VivoBook 15 X1504',
                'category_id' => 4, 'brand_id' => 3, 'model' => 'X1504',
                'cpu' => 'Intel Core i5-1235U', 'ram' => '8GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'Intel UHD Graphics',
                'screen' => '15.6" FHD', 'os' => 'Windows 11',
                'weight' => 1.70, 'battery' => '42Wh',
                'price' => 13990000,
                'stock' => 35, 'warranty' => '24 tháng',
                'image' => $img('asus-vivobook-15'),
            ],
            [
                'name' => 'Asus TUF Gaming A15 FA507',
                'category_id' => 1, 'brand_id' => 3, 'model' => 'FA507',
                'cpu' => 'AMD Ryzen 7 7735HS', 'ram' => '16GB DDR5',
                'storage' => '512GB SSD', 'gpu' => 'NVIDIA RTX 4050 6GB',
                'screen' => '15.6" FHD 144Hz', 'os' => 'Windows 11',
                'weight' => 2.20, 'battery' => '90Wh',
                'price' => 26990000, 'sale_price' => 24490000,
                'stock' => 16, 'warranty' => '24 tháng',
                'image' => $img('asus-tuf-a15'),
                'is_featured' => 1,
            ],
            [
                'name' => 'Acer Nitro 5 AN515-58',
                'category_id' => 1, 'brand_id' => 4, 'model' => 'AN515-58',
                'cpu' => 'Intel Core i5-12500H', 'ram' => '16GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'NVIDIA RTX 3050 4GB',
                'screen' => '15.6" FHD 144Hz', 'os' => 'Windows 11',
                'weight' => 2.50, 'battery' => '57.5Wh',
                'price' => 22990000, 'sale_price' => 20990000,
                'stock' => 12, 'warranty' => '12 tháng',
                'image' => $img('acer-nitro-5'),
                'is_featured' => 1,
            ],
            [
                'name' => 'Acer Swift 3 SF314',
                'category_id' => 2, 'brand_id' => 4, 'model' => 'SF314',
                'cpu' => 'Intel Core i5-1240P', 'ram' => '16GB LPDDR4X',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '14" 2.2K IPS', 'os' => 'Windows 11',
                'weight' => 1.20, 'battery' => '56Wh',
                'price' => 19990000, 'sale_price' => 17990000,
                'stock' => 20, 'warranty' => '12 tháng',
                'image' => $img('acer-swift-3'),
            ],
            [
                'name' => 'Acer Predator Helios 16',
                'category_id' => 1, 'brand_id' => 4, 'model' => 'PH16-71',
                'cpu' => 'Intel Core i9-13900HX', 'ram' => '32GB DDR5',
                'storage' => '1TB SSD', 'gpu' => 'NVIDIA RTX 4070 8GB',
                'screen' => '16" QHD+ 240Hz', 'os' => 'Windows 11',
                'weight' => 2.60, 'battery' => '90Wh',
                'price' => 56990000, 'sale_price' => 52990000,
                'stock' => 5, 'warranty' => '24 tháng',
                'image' => $img('acer-predator-helios'),
                'is_featured' => 1, 'is_new' => 1,
            ],
            [
                'name' => 'MSI Modern 14 C13M',
                'category_id' => 4, 'brand_id' => 5, 'model' => 'C13M',
                'cpu' => 'Intel Core i5-1335U', 'ram' => '8GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '14" FHD IPS', 'os' => 'Windows 11',
                'weight' => 1.40, 'battery' => '39Wh',
                'price' => 14990000,
                'stock' => 30, 'warranty' => '24 tháng',
                'image' => $img('msi-modern-14'),
            ],
            [
                'name' => 'MSI Katana 15 B13V',
                'category_id' => 1, 'brand_id' => 5, 'model' => 'B13V',
                'cpu' => 'Intel Core i7-13620H', 'ram' => '16GB DDR5',
                'storage' => '1TB SSD', 'gpu' => 'NVIDIA RTX 4060 8GB',
                'screen' => '15.6" FHD 144Hz', 'os' => 'Windows 11',
                'weight' => 2.25, 'battery' => '53.5Wh',
                'price' => 33990000, 'sale_price' => 30990000,
                'stock' => 9, 'warranty' => '24 tháng',
                'image' => $img('msi-katana-15'),
                'is_new' => 1,
            ],
            [
                'name' => 'Lenovo IdeaPad Slim 5 14ABR8',
                'category_id' => 2, 'brand_id' => 6, 'model' => '14ABR8',
                'cpu' => 'AMD Ryzen 5 7530U', 'ram' => '16GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'AMD Radeon Graphics',
                'screen' => '14" WUXGA IPS', 'os' => 'Windows 11',
                'weight' => 1.46, 'battery' => '57Wh',
                'price' => 16990000,
                'stock' => 18, 'warranty' => '24 tháng',
                'image' => $img('lenovo-ideapad-slim'),
                'is_new' => 1,
            ],
            [
                'name' => 'Lenovo ThinkPad E14 Gen 5',
                'category_id' => 2, 'brand_id' => 6, 'model' => 'E14 Gen 5',
                'cpu' => 'Intel Core i7-1355U', 'ram' => '16GB DDR4',
                'storage' => '512GB SSD', 'gpu' => 'Intel Iris Xe',
                'screen' => '14" WUXGA IPS', 'os' => 'Windows 11 Pro',
                'weight' => 1.41, 'battery' => '47Wh',
                'price' => 23990000, 'sale_price' => 21990000,
                'stock' => 12, 'warranty' => '12 tháng',
                'image' => $img('lenovo-thinkpad-e14'),
            ],
            [
                'name' => 'Lenovo Legion 5 16IRX9',
                'category_id' => 1, 'brand_id' => 6, 'model' => '16IRX9',
                'cpu' => 'AMD Ryzen 7 7840HS', 'ram' => '16GB DDR5',
                'storage' => '1TB SSD', 'gpu' => 'NVIDIA RTX 4060 8GB',
                'screen' => '16" WQXGA 165Hz', 'os' => 'Windows 11',
                'weight' => 2.40, 'battery' => '80Wh',
                'price' => 37990000, 'sale_price' => 34990000,
                'stock' => 7, 'warranty' => '24 tháng',
                'image' => $img('lenovo-legion-5'),
                'is_featured' => 1,
            ],
            [
                'name' => 'Apple MacBook Air M2 2022',
                'category_id' => 2, 'brand_id' => 7, 'model' => 'M2 2022',
                'cpu' => 'Apple M2 8-core', 'ram' => '8GB Unified',
                'storage' => '256GB SSD', 'gpu' => 'Apple GPU 8-core',
                'screen' => '13.6" Liquid Retina', 'os' => 'macOS',
                'weight' => 1.24, 'battery' => '52.6Wh',
                'price' => 28990000, 'sale_price' => 26990000,
                'stock' => 20, 'warranty' => '12 tháng',
                'image' => $img('macbook-air-m2'),
                'is_featured' => 1, 'is_new' => 1,
            ],
            [
                'name' => 'Apple MacBook Pro 14 M3',
                'category_id' => 3, 'brand_id' => 7, 'model' => 'M3 2023',
                'cpu' => 'Apple M3 Pro 11-core', 'ram' => '18GB Unified',
                'storage' => '512GB SSD', 'gpu' => 'Apple GPU 14-core',
                'screen' => '14.2" Liquid Retina XDR', 'os' => 'macOS',
                'weight' => 1.55, 'battery' => '70Wh',
                'price' => 52990000, 'sale_price' => 49990000,
                'stock' => 6, 'warranty' => '12 tháng',
                'image' => $img('macbook-pro-14-m3'),
                'is_featured' => 1, 'is_new' => 1,
            ],
            [
                'name' => 'Apple MacBook Air 15 M3',
                'category_id' => 2, 'brand_id' => 7, 'model' => 'M3 15"',
                'cpu' => 'Apple M3 8-core', 'ram' => '16GB Unified',
                'storage' => '512GB SSD', 'gpu' => 'Apple GPU 10-core',
                'screen' => '15.3" Liquid Retina', 'os' => 'macOS',
                'weight' => 1.51, 'battery' => '66.5Wh',
                'price' => 39990000, 'sale_price' => 36990000,
                'stock' => 9, 'warranty' => '12 tháng',
                'image' => $img('macbook-air-m3-15'),
                'is_new' => 1,
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }

        $this->command->info('Da seed: 2 users, 7 brands, 4 categories, ' . count($products) . ' products');
    }
}
