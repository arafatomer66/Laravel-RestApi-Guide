<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const UNAVAILABLE_PRODUCT = 'unavailable';
    const AVAILABLE_PRODUCT = 'available';
    protected $fillable = [
        'name','description','quantity','status','image','seller_id',
    ];
    // we should declar with const for the values when they hve fix values

    public function isAvailable(){
        return $this->status == Product::AVAILABLE_PRODUCT; //return true
    }

}
