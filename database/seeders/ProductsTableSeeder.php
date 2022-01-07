<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name'=> 'IPhone X 64GB', 'code' => 'iphone_x_64', 'description' => 'Super technological device', 'image' => 'products/iphone_x_64.jpeg', 'price' => '89990', 'category_id' => 1, 'hit' => 1, 'new' => 1, 'recommended' => 0,'count' => rand(0,20)],
            ['name'=> 'IPhone X 256GB', 'code' => 'iphone_x_256', 'description' => 'Technologies are in your pocket.', 'image' => 'products/iphone_x_256.webp', 'price' => '108990', 'category_id' => 1, 'hit' => 1, 'new' => 1, 'recommended' => 0,'count' => rand(0,20)],
            ['name'=> 'Samsumg A71', 'code' => 'samsung_a71', 'description' => 'Smart and perfect for a reasonable price', 'image' => 'products/samsung_a71.jpeg', 'price' => '49900', 'category_id' => 1, 'hit' => 1, 'new' => 0, 'recommended' => 0,'count' => rand(0,20)],
            ['name'=> 'Huawei Honor P90', 'code' => 'huawei_honor_p90', 'description' => 'The most selling phone in South Korea', 'image' => 'products/huawei_honor_p90.jpeg', 'price' => '39999', 'category_id' => 1, 'hit' => 1, 'new' => 1, 'recommended' => 0,'count' => rand(0,20)],
            ['name'=> 'Camera GoPro 2', 'code' => 'go_pro2', 'description' => 'PROactive camera for capturing your best emotions', 'image' => 'products/go_pro2.jpeg', 'price' => '26990', 'category_id' => 2, 'hit' => 1, 'new' => 1, 'recommended' => 1,'count' => rand(0,20)],
            ['name'=> 'Samsumg EarBuds 3', 'code' => 'samsung_earbuds3', 'description' => 'The most pure sound easily connected your phone and your heart through ears', 'image' => 'products/samsung_earbuds3.webp', 'price' => '17990', 'category_id' => 2, 'hit' => 0, 'new' => 1, 'recommended' => 1,'count' => rand(0,20)],
            ['name'=> 'Apple AirPods 2', 'code' => 'apple_airpods2', 'description' => 'Legendary headphones for the best expirience with your favorite songs', 'image' => 'products/apple_airpods2.jpeg', 'price' => '36990', 'category_id' => 2, 'hit' => 0, 'new' => 1, 'recommended' => 1,'count' => rand(0,20)],
            ['name'=> 'Philips Teapot Ml', 'code' => 'philips_teapot_s', 'description' => 'Hot water for your drinks 24/7', 'image' => 'products/philips_teapot_s.jpeg', 'price' => '7990', 'category_id' => 3, 'hit' => 1, 'new' => 1, 'recommended' => 1,'count' => rand(0,20)],
            ['name'=> 'Haier Dishwasher', 'code' => 'haier_dishwasher', 'description' => 'Cleansiness is the second name of your dining tableware from now on', 'image' => 'products/haier_dishwasher.jpeg', 'price' => '89990', 'category_id' => 3, 'hit' => 0, 'new' => 0, 'recommended' => 0,'count' => rand(0,20)],
            ['name'=> 'Apple Station Smart Home', 'code' => 'aplle_station_smart_home', 'description' => 'Your home can be protected from invasions', 'image' => 'products/aplle_station_smart_home.jpeg', 'price' => '29900', 'category_id' => 3, 'hit' => 1, 'new' => 0, 'recommended' => 0,'count' => rand(0,20)],
        ]);
    }
}
