<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\User;
use App\Product ;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use PHPUnit\Framework\MockObject\Stub\Exception;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
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

        $data['image'] = $request->image->store('');

        $data['seller_id'] = $seller->id ;

        $product = Product::create($data);

        return $this->showOne($product);
    }
    public function update(Request $request, Seller $seller , Product $product)
    {
        $rules = [
            'quantity'=> 'integer|min:1' ,
            'status'  => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'image'   => 'image'
        ] ;

        $this->validate($request , $rules);
        $this->checkSeller( $seller , $product);


        $product->fill($request->only([
            'name','description', 'quantity',
        ]));

        if($request->has('status')){
            $product->status =$request->status ;

            if($product->isAvailable() && $product->categories()->count() == 0 ){
                return $this->errorResponse('Category is invalid' , 409);
            }
        }
        if($request->hasFile('image')){
            Storage::delete($product->image);

            $product->image = $request->image->store('');
        }

        $product->save();

        return $this->showOne($product);

    }
    public function destroy(Seller $seller , Product $product)
    {

         $this->checkSeller($seller , $product);
         Storage::delete($product->image);
         $product->delete();
         return $this->showOne($product);

    }

    public function checkSeller(Seller $seller , Product $product){
        if($seller->id != $product->seller_id ){
           return $this->errorResponse('error',422);
        }
    }
}
