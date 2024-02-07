<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(Request $request){
        return view('login');
    }

    public function auth(Request $request){
        $username=$request['username'];
        $password=$request['password'];
        if(Auth::attempt(['username' => $username, 'password' => $password])){
            $user=Auth::user();
            if($user->role=='user'){
                return redirect()->route('index');
            }else if($user->role=='admin'){
                return redirect()->route('admin.index');
            }
            
        }else{
            return redirect()->route('login')->withErrors(['login'=>'Invalid email or password']);
        }
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
    
    public function register(Request $request)
    {

        $user=User::where('username', $request['username'])->first();
        
        if($user){
            return response()->json(['errors' => ['username' => 'This username is taken']], 422); 
        }

        $user= new User();
        $user->username=$request['username'];
        $user->name=$request['name'];
        $user->role="user";
        $user->email=$request['email'];
        $user->phone=$request['phone'];
        $user->gender=$request['gender'];
        $user->password=bcrypt($request['password']);
        $user->photo="default.jpg";
        $user->save();
        return true;

    }
}
