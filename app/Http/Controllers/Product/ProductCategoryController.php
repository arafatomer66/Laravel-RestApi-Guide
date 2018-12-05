<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Category;

class ProductCategoryController extends ApiController
{

    public function index(Product $product)
    {
        $categories = $product->categories ;
        return $this->showAll($categories);
    }

    public function update(Request $request, Product $product , Category $category )
    {
        //many to many relation apporch
        //approches are : attach , sync , syncWithoutDetach
         // attach takes all the values in api
         //sync takes only one and overrides all
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories);
    }
    public function destroy(Product $product , Category $category )
    {
        //removing relations
        if(!$product->categories()->find($category->id)){
            return $this->errorResponse('Invalid deletation' , 404);
        }
        $product->categories()->detach($category->id);
        return $this->showAll($product->categories);
    }
}
