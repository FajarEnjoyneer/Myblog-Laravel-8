<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = Category::onlyParent()->with('descendants')->get();
        return view('categories.index',compact('categories'));
    }
    public function select(Request $request)
    {
        $categories = [];
    
        if ($request->has('q')) {
            $search = $request->q;
            $categories = Category::select('id', 'title')->where('title', 'LIKE', "%$search%")->limit(6)->get();
        } else {
            $categories = Category::select('id', 'title')->onlyParent()->limit(6)->get();
        }
    
        return response()->json($categories);
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:60',
        'slug' => 'required|string|unique:categories,slug',
        'thumbnail' => 'required',
        'description' => 'required|string|max:240',
    ],
    [],
    $this->attributes()
);

    if ($validator->fails()) {
        if ($request->has('parent_category')) {
            $request['parent_category'] = Category::select('id', 'title')->find($request->parent_category);
        }
        return redirect()->back()->withInput($request->except('password'))->withErrors($validator);
    }

    // Proses insert data
    // Gantilah dd("proses insert data", $request->all()); dengan kode yang sesuai untuk menyimpan data ke database.
    dd("proses insert data", $request->all());
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    private function attributes()
    {
        return[
        'title' => trans('categories.form_control.input.title.attribute'),
        'slug' => trans('categories.form_control.input.slug.attribute'),
        'thumbnail' => trans('categories.form_control.input.thumbnail.attribute'),
        'description' => trans('categories.form_control.textarea.description.attribute'),
        ];
    }
}
