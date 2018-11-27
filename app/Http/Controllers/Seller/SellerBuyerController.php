<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerBuyerController extends ApiController
{
  
    public function index(Seller $seller)
    {
        $buyers = $seller->products()->whereHas('transactions')->with('transactions')->get()->pluck('transactions')->collapse() ; 
        return $this->showAll($buyers);
    }

}
