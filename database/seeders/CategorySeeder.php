<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('categories')->delete();
        $cat = [
           'Shirts',
            'Jeans',
            'Jackets',
            'Shoes',
            'Blazers',
            'SportsWear',
            'SwimWear',

        ];
        /*foreach ($cat as $cats)
        Db::table('categories')->insert(['category_name'=>$cats]);*/
        foreach ($cat as $cats)
            Category::create(['name'=>$cats]);
    }

}
