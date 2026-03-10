<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Крупа',
            'Спагетти',
            'Макаронные изделия',
            'Мука',
            'Соль',
            'Овощи',
            'Яйца'
        ];

        foreach($categories as $name){
            Category::create(['name'=>$name]);
        }
    }
}
