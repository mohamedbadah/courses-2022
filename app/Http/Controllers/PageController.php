<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $courses=Course::all();
        return view('layouts.index',['courses'=>$courses]);
    }
    public function course($slug){
        $course=Course::where("slug",$slug)->first();
        return view('layouts.course',['course'=>$course]);
    }
    public function register($slug){
        $course=Course::where('slug',$slug)->first();
        return view('layouts.register')->with('course',$course);
    }
    public function registerSubmit(Request $request,$slug){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
            'gender'=>'required'
        ]);

        $course=Course::where('slug',$slug)->select('id')->first();
        $user=User::where('email',$request->email)->first();
       

        if(is_null($user)){
          $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'gender'=>$request->gender
            ]);
        }
     $register= Registration::create([
      'user_id'=>$user->id,
      'course_id'=>$course->id
     ]);
        return redirect()->route('pay',$register->id);
    }

    public function pay($id){
        $register=Registration::find($id);
        return view("layouts.pay",compact("register"));
    }
    public function thank($id){
        Registration::find($id)->update([
            'status'=>1
        ]);
        return redirect()->route("homePage");
    }

    public function search(Request $request){
        $courses=Course::where("name","like","%".$request->s."%")->orWhere("content","like","%".$request->s."%")->get();
        return view("layouts.index",compact("courses"));
    }
}
