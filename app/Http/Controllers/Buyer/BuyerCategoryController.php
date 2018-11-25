<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()
        ->with('product.categories')
        ->get()
        ->pluck('product.categories')
        ->collapse()
        ->unique('id')
        ->values();
   //collapse is use to get data of collection inside a collection
        return $this->showAll($sellers);  
    }
}

//all the categories where buyer made any kind of purchase
