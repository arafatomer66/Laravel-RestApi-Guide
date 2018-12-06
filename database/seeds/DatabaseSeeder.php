<?php
use App\User ;
use App\Product ;
use App\Transaction ;
use App\Category ;

use Illuminate\Database\Facades\DB ;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //WHEN trucating rereign keys should be zero

        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // User::trancate();
        // Category::trancate();
        // Transaction::trancate();
        // Product::trancate();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //DB::table('category_product')->trancate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();

        $usersQuantity = 200 ;
        $categoriesQuantity = 30 ;
        $productsQuantity = 1000 ;
        $transactionsQuantity = 1000 ;

        factory(User::class , $usersQuantity)->create();
        factory(Category::class , $categoriesQuantity)->create();
        factory(Product::class , $productsQuantity)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );
        factory(Transaction::class , $transactionsQuantity)->create();
    }
}
