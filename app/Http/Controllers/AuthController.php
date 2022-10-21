<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function getRegister(){
        return view('auth.register');
    }
    public function register(Request $request){
    $validator=Validator($request->all(),[
        'name'=>'required',
        'email'=>'required|unique:users,email',
        'password'=>'required|string|min:3|max:20',
        'cPassword'=>'required|same:password'
    ]);
    if(!$validator->fails()){
     $user=new User();
     $user->name=$request->name;
     $user->email=$request->email;
     $user->password=Hash::make($request->password);
     $isSaved=$user->save();
     return response()->json(['message'=>$isSaved ? "success":"faild"],Response::HTTP_OK);
    }else{
        return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
    }
    }
    public function getLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
     $validator=Validator($request->all(),[
      'email'=>'required',
      'password'=>'required'
     ]);
     if(!$validator->fails()){
        $cred=['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($cred)){
            return response()->json(['message'=>"successfully login"],Response::HTTP_OK);
        }else{
            return response()->json(['message'=>"faild login"],Response::HTTP_BAD_REQUEST);
        }
     }else{
        return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
     }
    }
    public function logout(Request $request){
        auth('web')->logout();
        $request->session()->invalidate();
        return redirect()->route('logout','web');
    }
}
