<?php

namespace App;
use App\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates =['deleted_at'] ;
    protected $fillable = [
       'name' ,
       'description',
    ];
    // we can assign those fields massively

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
