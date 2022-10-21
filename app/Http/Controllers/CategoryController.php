<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $categories=Category::withCount('courses')->latest()->paginate(1);
        return view("cms.category.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cms.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator=$request->validate([
            'name'=>'required|string|min:3|max:20'
        ],[
            'name.required'=>"الحقل مطلوب"
        ]);
        if($validator){
            Category::create([
                'name'=>$request->name,
                'slug'=>Str::slug($request->name)
            ]);
            return redirect()->route('category.index')->with("success","successfully created new category"); 
        }
        
        
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
        return view("cms.category.edit",['category'=>$category]);
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
        Validator::make($request->all(),[
            'name'=>'required'
        ])->validate();
        $category->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name)
        ]);
        return redirect()->route('category.index')->with('success','category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $isDeleted=$category->delete();
        if($isDeleted){
        return redirect()->route('category.index')->with("success","deleted successfully");
        }
    }
    public function CategoryToCourse($slug){
    $category=Category::with('courses')->where('slug',$slug)->first();
    return view("cms.course.coursesToCategory",compact('category'));
    }
}
