<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        // Seed categories

        $categories = [
            'Fiction',
            'Non-Fiction',
            'Science Fiction',
            'Fantasy',
            'Mystery',
            'Thriller',
            'Romance',
            'Historical Fiction',
            'Biography',
            'Autobiography',
            'Self-Help',
            'Business',
            'Technology',
            'Science',
            'Health',
            'Cooking',
            'Travel',
            'History',
            'Philosophy',
            'Psychology',
            'Art',
            'Music',
            'Sports',
            'Children',
            'Young Adult',
            'Reference',
            'Religion',
            'Poetry',
            'Drama',
        ];
        
        // Clear existing data to start fresh
        Category::truncate();

        foreach ($categories as $category) {
             Category::create(['name' => $category]);
        }
    }
}
