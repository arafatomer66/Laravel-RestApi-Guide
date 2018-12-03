<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Buyer;
use App\User;
use App\Transaction;
use App\Seller;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    public function store(Request $request , Product $product , User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1' ,
        ] ;
        $this->validate($request ,$rules);
        if($buyer->id == $product->seller_id){
            return $this->errorResponse('Seller and buyer is same person' , 409);
        }
        if(!$buyer->isVerified()){ 
            return $this->errorResponse('Buyer not verified' , 409);
        }
        if(!$product->seller->isVerified()){
            return $this->errorResponse('Seller not verified' , 409);
        }
        if(!$product->isAvailable()){
            return $this->errorResponse('Product not available' , 409);
        }
        if($product->quantity < $request->quantity){
            return $this->errorResponse('Products are not fully available' , 409);
        }
        return DB::transaction(function () use ( $request ,$product , $buyer )  {
            $product->quantity = $product->quantity - $request->quantity ;
            $product->save() ;
            $transaction = Transaction::create(
                [
                    'quantity' => $request->quantity,
                    'buyer_id' => $buyer->id ,
                    'product_id' => $product->id
                ]
                );
                return $this->showOne($transaction ,201);
        });
    }
}
