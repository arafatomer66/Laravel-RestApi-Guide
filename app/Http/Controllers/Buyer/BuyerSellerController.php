<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()
        ->with('product.seller')
        ->get()
        ->pluck('product.seller')
        ->unique('id')
        ->values();
   //can be multiple seller so nunique and for that their can be exmty index so use values()
        return $this->showAll($sellers);
    }
}
