<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_id'=>1,'name' => 'Мобильные телефоны', 'code' =>'mobiles', 'description' => 'Описание для мобильных телефонов', 'image' => 'categories/mobiles.jpeg'], 
                ['category_id'=>2,'name' => 'Портативная техника', 'code' =>'portable', 'description' => 'Описание для портативной техники', 'image' => 'categories/portable.jpeg'], 
            ['category_id'=>3,'name' => 'Бытовая техника', 'code' =>'appliances', 'description' => 'Описание для бытовой техники', 'image' => 'categories/appliances.jpeg'], 

        ]);
    }
}
