<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories);
    }



    public function store(Request $request)
    {
        $rules = [
          'name' => 'required',
          'description' => 'required'
        ];

        $this->validate($request, $rules);

        $newCategory = Category::create($request->all());

        return $this->showOne($newCategory, 201);
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);

        return $this->showOne($category);
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->fill($request->intersect([
            'name',
            'description'
        ]));

        if ($category->isClean()){
            return $this->errorResponse('You need to specify any difference value to update', 422);
        }

        $category->save();

        return $this->showOne($category);
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return $this->showOne($category);
    }
}
