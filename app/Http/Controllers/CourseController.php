<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Registration;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses=Course::latest()->paginate(10);
        return view("cms.course.index",['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::select('id','name')->get();
        return view("cms.course.create",['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'=>'required|unique:courses,name',
        'image'=>'required|mimes:jpg,png',
        'category'=>'required'
        ]);
        $ex=$request->file("image")->getClientOriginalExtension();
        $new_image="course".".".time().".".$ex;
        $request->file("image")->move(public_path("upload"),$new_image);
        Course::create([
         'name'=>$request->name,
         'slug'=>Str::slug($request->name),
         'content'=>$request->content,
         'image'=>$new_image,
         'categories_id'=>$request->category
        ]);
        return redirect()->route("course.index")->with("success","successfully creared new course");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories=Category::select('id','name')->get();
        return view("cms.course.edit",compact('course','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $new_image=$course->image;
        if($request->hasFile("image")){
            $image=$request->file("image");
            $new_image='course_'.".".time().".".$image->getClientOriginalExtension();
            Storage::disk("upload")->delete($course->image);
            $image->move(public_path("upload"),$new_image);
        }
        $course->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'content'=>$request->content,
        ]);
        return redirect()->route("course.index")->with("success","successfully updated course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $isDeleted=$course->delete();
        if($isDeleted){
            return redirect()->route("course.index")->with("success","the coourses deleted successfully");
        }
    }

    public function registeration(){
        $registerations=Registration::all();
        return view("cms.registeration.index",compact("registerations"));

    }
    public function deleteRegister($id){
     $registeration=Registration::where("id",$id)->first();
     $isDeleted=$registeration->delete();
     if($isDeleted){
        return redirect()->route("all-registeration");

     }
    }
}
