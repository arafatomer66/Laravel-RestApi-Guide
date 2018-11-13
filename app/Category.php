<?php

namespace App;
use App\product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{  
    
    protected $fillable = [
       'name' ,
       'description',
    ];
    // we can assign those fields massively

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
