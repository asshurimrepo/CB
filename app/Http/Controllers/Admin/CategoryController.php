<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return Category::orderBy('id', 'desc')->get();
        }

        return view('admin.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $categories)
    {
        $inputs = $request->all();
        $inputs['slug'] = str_slug($inputs['name']);

        $categories->fill($inputs);
        $categories->save();

        return $categories;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $categories)
    {
        $inputs = $request->all();
        $inputs['slug'] = str_slug($inputs['slug']);

        $categories->fill($inputs);
        $categories->save();

        return $categories;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categories)
    {
        $categories->delete();
        return $categories;
    }

    public function lists(Category $categories)
    {
        return $categories->get(['name', 'id']);
    }
}
