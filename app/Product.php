<?php

namespace App;
use App\Category;
use App\Seller;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\ProductTransformer;


class Product extends Model
{

    use SoftDeletes;
    protected $dates =['deleted_at'] ;
    public $transformer = ProductTransformer::class ;
    const UNAVAILABLE_PRODUCT = 'unavailable';
    const AVAILABLE_PRODUCT = 'available';
    protected $fillable = [
        'name','description','quantity','status','image','seller_id',
    ];

    protected $hidden = [
        'pivot'
    ];
    // we should declar with const for the values when they hve fix values

    public function isAvailable(){
        return $this->status == Product::AVAILABLE_PRODUCT; //return true
    }

      public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);


    }
}
