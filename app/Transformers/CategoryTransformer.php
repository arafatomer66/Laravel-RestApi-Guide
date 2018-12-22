<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category ;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier' =>(int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'creationDate' =>(string)$category->created_at ,
            'lastChange' => (string)$category->updated_at ,
            'deletedDate' => isset($category->deleted_at)? (string) $category->deleted_at : null ,
        ];
    }

    public static function originalAttribute ($index){
        $attribute = [
            'identifier' =>'id',
            'title' => 'name',
            'details' => 'description',
            'creationDate' =>'created_at' ,
            'lastChange' => 'updated_at' ,
            'deletedDate' => 'deleted_at' ,

            'links' => [
                 'rel' => 'self',
                 'href' => route('categories.show' , $category->id),
            ],
        ];
        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }

}
