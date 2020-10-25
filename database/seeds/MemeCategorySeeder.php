<?php

use Illuminate\Database\Seeder;
use App\Category;

class MemeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'horror'
        ]);

        Category::create([
            'name' => 'comedy'
        ]);

        Category::create([
            'name' => 'sad'
        ]);

        Category::create([
            'name' => 'animals'
        ]);

        Category::create([
            'name' => 'music'
        ]);
    }
}
