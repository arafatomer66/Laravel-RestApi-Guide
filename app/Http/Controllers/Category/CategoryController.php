<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Category ;

class CategoryController extends ApiController
{


   public function __construct()
   {
    //    parent::__construct();
    $this->middleware('client.credentials')->only(['index' ,'show']);
    $this->middleware('auth:api')->except(['index','show']);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' =>'required' ,
        ];

        $this->validate($request , $rules);

        $newCategory = Category::create($request->all());

        return $this->showOne($newCategory,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $category = Category::findOrFail($id);
    //     return $this->showOne($category);
    // }

    public function show(Category $category)
    {

        return $this->showOne($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $category->has([
        //     'name','description',
        //     //cheaking   if arrtibutes with different are coming from api
        // ]);

        // if ($request->has(['name', 'description'])) {
        //     //
        //     dd('hi');
        // }

        $category = Category::findOrFail($id);

        if($request->has('name')){
            $category->name = $request->name ;
        }

        if($request->has('description')){
            $category->description = $request->description ;
        }

        if(!$category->isDirty()){
           return $this->errorResponse('You need to specify values to update',422);
        }
        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
        // $category = Category::findOrFail($id);
        // $category->delete();
        // return $this->showOne($category);
    }
}
