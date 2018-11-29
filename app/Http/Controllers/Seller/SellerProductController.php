<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\User;
use App\Product ;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerProductController extends ApiController
{
   
    public function index(Seller $seller)
    {
        $product = $seller->products;
        return $this->ShowAll($product);
    }
    // User $seller , seller maybe new so assign to a user
    public function store(Request $request , User $seller)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image'
        ];
        
        $this->validate($request , $rules);

        $data = $request->all();

        $data['status'] =Product::UNAVAILABLE_PRODUCT ;

        $data['image'] = '1.jpg';

        $data['seller_id'] = $seller->id ;

        $product = Product::create($data);

        return $this->showOne($product);


    }

    public function update(Request $request, Seller $seller)
    {
        
    }

    public function destroy(Seller $seller)
    {
        
    }
}
