<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        // $products = $buyer->transactions->product;
        $products = $buyer->transactions()->with('product')->get()->pluck('product');
        //this is a collection, pluck method goes inside the collection and return specifice index


        return $this->showAll($products);
    }


}
