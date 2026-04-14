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
        $cats = [
            'Laptop Gaming' => 'Laptop chuyên game, hiệu năng cao',
            'Laptop Văn phòng' => 'Mỏng nhẹ, pin trâu, phù hợp công việc',
            'Laptop Đồ họa' => 'Card đồ họa rời mạnh, RAM lớn',
            'Laptop Sinh viên' => 'Giá hợp lý, đáp ứng nhu cầu học tập',
        ];
        foreach ($cats as $name => $desc) {
            Category::create(['name' => $name, 'description' => $desc]);
        }

        // ===== PRODUCTS =====
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
                'image' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/np960xfg-ka1vn/gallery/vn-galaxy-book4-pro-360-np960xfg-ka1vn-thumb-538965996',
                'is_featured' => 1, 'is_new' => 1,
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
                'image' => 'https://dlcdnwebimgs.asus.com/gain/8b9a5dac-5681-4cea-bf4f-7e5cd5e1c3da/',
                'is_featured' => 1,
            ],
            [
                'name' => 'MacBook Air M2 2022',
                'category_id' => 2, 'brand_id' => 7, 'model' => 'M2 2022',
                'cpu' => 'Apple M2 8-core', 'ram' => '8GB Unified',
                'storage' => '256GB SSD', 'gpu' => 'Apple GPU 8-core',
                'screen' => '13.6" Liquid Retina', 'os' => 'macOS',
                'weight' => 1.24, 'battery' => '52.6Wh',
                'price' => 28990000, 'sale_price' => 26990000,
                'stock' => 20, 'warranty' => '12 tháng',
                'image' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/macbook-air-midnight-select-20220606',
                'is_featured' => 1, 'is_new' => 1,
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
                'image' => 'https://www.hp.com/wcsstore/hpusstore/Treatment/CES2023/Pav15Spruce_HD.png',
                'is_featured' => 1,
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
                'image' => 'https://p3-ofp.static.pub/fes/cms/2023/05/05/abc.png',
                'is_new' => 1,
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
                'image' => 'https://static.acer.com/up/Resource/Acer/Laptops/Nitro_5/Photogallery/2022/Nitro_5_AN515-58_FP_Wallpaper_01.png',
                'is_featured' => 1,
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
                'image' => 'https://asset.msi.com/resize/image/global/product/product_16769671094c2cf7b9c12fa0f6d35b0a2628c5dab2.png62405b38c58fe0f07fcef2367d8a9ba1/600.png',
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
                'image' => 'https://dlcdnwebimgs.asus.com/gain/29a92c87-9f8a-4361-9c6e-0c4f3da3a82a/',
                'is_new' => 1,
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }

        $this->command->info('Da seed thanh cong: 2 users, 7 brands, 4 categories, 8 products');
    }
}
