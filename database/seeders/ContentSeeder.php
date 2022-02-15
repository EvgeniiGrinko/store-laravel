<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'name' => 'Цвет',
                'name_en' => 'Color',
                'options' => [
                    [
                        'name' => 'Белый',
                        'name_en' => 'White',
                    ],
                    [
                        'name' => 'Черный',
                        'name_en' => 'Black',
                    ],
                    [
                        'name' => 'Серебристый',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Золотой',
                        'name_en' => 'Gold',
                    ],
                    [
                        'name' => 'Синий',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Красный',
                        'name_en' => 'Silver',
                    ],
                ],
            ],
            [
                'name' => 'Внутрення память',
                'name_en' => 'Memory',
                'options' => [
                    [
                        'name' => '32 гб',
                        'name_en' => '32 gb',
                    ],
                    [
                        'name' => '64 гб',
                        'name_en' => '64 gb',
                    ],
                    [
                        'name' => '128 гб',
                        'name_en' => '128 gb',
                    ],
                ]
            ],
        ];
        foreach ($properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();
            $options = $property['options'];
            unset($property['options']);
            $propertyId = DB::table('properties')->insertGetId($property);

            foreach ($options as $option) {
                $option['created_at'] = Carbon::now();
                $option['updated_at'] = Carbon::now();
                $option['property_id'] = $propertyId;
                DB::table('property_options')->insert($option);
            }
        }

        $categories = [
            [
                'category_id' => 1,
                'name' => 'Мобильные телефоны',
                'name_en' => 'Mobile phones',
                'code' => 'mobiles',
                'description' => 'Сотовые телефоны сделают соединяют вас и вваших близких',
                'description_en' => 'Cellular phones will make your life more connected',
                'image' => 'categories/mobiles.jpeg',
                'products' =>
                    [
                        [
                            'name' => 'IPhone XI',
                            'name_en' => 'IPhone XI',
                            'code' => 'iphone_x_64',
                            'description' => 'Super technological device',
                            'description_en' => 'Super technological device',
                            'image' => 'products/iphone_x_64.jpeg',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    1, 7,
                                ],
                                [
                                    1, 8,
                                ],
                                [
                                    2, 7,
                                ],
                                [
                                    2, 8,
                                ],
                                [
                                    3, 7,
                                ],
                                [
                                    3, 8,
                                ],
                                [
                                    4, 7,
                                ],
                                [
                                    4, 8,
                                ],
                            ],
                        ],
                        [
                            'name' => 'IPhone X',
                            'name_en' => 'IPhone X',
                            'code' => 'iphone_x',
                            'description' => 'Technologies are in your pocket.',
                            'description_en' => 'Technologies are in your pocket.',
                            'image' => 'products/iphone_x_256.webp',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    1, 8,
                                ],
                                [
                                    1, 9,
                                ],
                                [
                                    2, 8,
                                ],
                                [
                                    2, 9,
                                ],
                                [
                                    3, 8,
                                ],
                                [
                                    3, 9,
                                ],
                                [
                                    4, 8,
                                ],
                                [
                                    4, 9,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Samsung A71',
                            'name_en' => 'Samsung A71',
                            'code' => 'samsung_a71',
                            'description' => 'Smart and perfect for a reasonable price',
                            'description_en' => 'Smart and perfect for a reasonable price',
                            'image' => 'products/samsung_a71.jpeg',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    1, 8,
                                ],
                                [
                                    1, 9,
                                ],
                                [
                                    2, 8,
                                ],
                                [
                                    2, 9,
                                ],
                                [
                                    3, 8,
                                ],
                                [
                                    3, 9,
                                ],
                                [
                                    4, 8,
                                ],
                                [
                                    4, 9,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Huawei Honor P90',
                            'name_en' => 'Huawei Honor P90',
                            'code' => 'huawei_honor_p90',
                            'description' => 'The most selling phone in South Korea',
                            'description_en' => 'The most selling phone in South Korea',
                            'image' => 'products/huawei_honor_p90.jpeg',
                            'properties' => [
                                1, 2,
                            ],
                            'options' => [
                                [
                                    2, 7,
                                ],
                                [
                                    2, 8,
                                ],
                            ],
                        ],
                    ],
            ],
            [
                'category_id' => 2,
                'name' => 'Портативная техника',
                'name_en' => 'Portable devices',
                'code' => 'portable',
                'description' => 'Портативные девайсы делают жизнь комфортной',
                'description_en' => 'Portable devices make your life comfortable',
                'image' => 'categories/portable.jpeg',
                'products' => [
                    [
                        'name' => 'Camera GoPro 2',
                        'name_en' => 'Camera GoPro 2',
                        'code' => 'go_pro2',
                        'description' => 'PROactive camera for capturing your best emotions',
                        'description_en' => 'PROactive camera for capturing your best emotions',
                        'image' => 'products/go_pro2.jpeg',
                    ],
                    [
                        'name' => 'Samsung EarBuds 3',
                        'name_en' => 'Samsung EarBuds 3',
                        'code' => 'samsung_earbuds3',
                        'description' => 'The most pure sound easily connected your phone and your heart through ears',
                        'description_en' => 'The most pure sound easily connected your phone and your heart through ears',
                        'image' => 'products/samsung_earbuds3.webp',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ]
                        ],
                    ],
                    [
                        'name' => 'Apple AirPods 2',
                        'name_en' => 'Apple AirPods 2',
                        'code' => 'apple_airpods2',
                        'description' => 'Legendary headphones for the best expirience with your favorite songs',
                        'description_en' => 'Legendary headphones for the best expirience with your favorite songs',
                        'image' => 'products/apple_airpods2.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ]
                        ],
                    ],

                ],
            ],
            ['category_id' => 3,
                'name' => 'Бытовая техника',
                'name_en' => 'Appliances',
                'code' => 'appliances',
                'description' => 'С бытовой техникой домашние дела становятся удовольствием',
                'description_en' => 'With house appliances house chores are pleasure for you',
                'image' => 'categories/appliances.jpeg',
                'products' => [
                    [
                        'name' => 'Philips Teapot Ml',
                        'name_en' => 'Philips Teapot Ml',
                        'code' => 'philips_teapot_s',
                        'description' => 'Hot water for your drinks 24/7',
                        'description_en' => 'Hot water for your drinks 24/7',
                        'image' => 'products/philips_teapot_s.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Haier Dishwasher',
                        'name_en' => 'Haier Dishwasher',
                        'code' => 'haier_dishwasher',
                        'description' => 'Cleansiness is the second name of your dining tableware from now on',
                        'description_en' => 'Cleansiness is the second name of your dining tableware from now on',
                        'image' => 'products/haier_dishwasher.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                3,
                            ]
                        ],
                    ],
                    [
                        'name' => 'Apple Station Smart Home',
                        'name_en' => 'Apple Station Smart Home',
                        'code' => 'aplle_station_smart_home',
                        'description' => 'Your home can be protected from invasions',
                        'description_en' => 'Your home can be protected from invasions',
                        'image' => 'products/aplle_station_smart_home.jpeg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],


                ],
            ],

        ];
        foreach ($categories as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();
            $products = $category['products'];
            unset($category['products']);
            $categoryId = DB::table('categories')->insertGetId($category);
            foreach ($products as $product) {
//                dd(array_key_exists('0',$product));
                $product['created_at'] = Carbon::now();
                $product['hit'] = !boolval(rand(0, 3));
                $product['recommended'] = rand(0, 1);
                $product['new'] = rand(0, 1);
                $product['updated_at'] = Carbon::now();
                $product['category_id'] = $categoryId;
                if (isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                }
                if (isset($product['options'])) {
                    $options = $product['options'];
                    unset($product['options']);
                }
//                dd($products);
                $productId = DB::table('products')->insertGetId($product);

                // property_product
                if (isset($properties)) {
                    foreach ($properties as $propertyId) {
                        DB::table('property_product')->insert(
                            [
                                'property_id' => $propertyId,
                                'product_id' => $productId,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]
                        );

                    }
                    unset($properties);
                }
                if (isset($options)) {
                    foreach ($options as $sku_options) {
                        $skuId = DB::table('skus')->insertGetId(
                            [
                                'product_id' => $productId,
                                'count' => rand(0, 100),
                                'price' => rand(5000, 150000),
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]
                        );
                        foreach ($sku_options as $option) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $option;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();
//                            dd($skuData);
                            DB::table('sku_property_option')->insert($skuData);

                        }

                    }
                    unset($options);
                } else {
                    DB::table('skus')->insert(
                        [
                            'product_id' => $productId,
                            'count' => rand(0, 100),
                            'price' => rand(5000, 150000),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    );
                }

            }
        }
    }
}
