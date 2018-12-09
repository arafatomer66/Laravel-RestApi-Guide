<?php

namespace App;
use App\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\CategoryTransformer;

class Category extends Model
{
    use SoftDeletes;
    protected $dates =['deleted_at'] ;
    public $transformer = CategoryTransformer::class ;
    protected $fillable = [
       'name' ,
       'description',
    ];

    protected $hidden = [
        'pivot'
    ];
    // we can assign those fields massively

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
