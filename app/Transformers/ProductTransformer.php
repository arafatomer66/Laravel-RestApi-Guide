<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

use App\Product ;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier' =>(int) $product->id,
            'title' => (string) $product->name,
            'details' => (string) $product->description,
            'stock' => (int) $product->quantity,
            'situation' => (string) $product->status,
            'picture' =>  url("img/{$product->images}"),
            'seller' => (int)$product->seller_id,
            'creationDate' => (string)$product->created_at ,
            'lastChange' =>  (string)$product->updated_at ,
            'deletedDate' => isset( $product->deleted_at)? (string)  $product->deleted_at : null ,
        ];
    }

    public static function originalAttribute ($index){
        $attribute = [
            'identifier' =>'id',
            'title' => 'name',
            'details' => 'description',
            'stock' => 'quantity',
            'situation' => 'status',
            'picture' => 'images',
            'seller' => 'seller_id',
            'creationDate' => 'created_at' ,
            'lastChange' =>  'updated_at' ,
            'deletedDate' =>'deleted_at' ,
        ];
        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }
}
