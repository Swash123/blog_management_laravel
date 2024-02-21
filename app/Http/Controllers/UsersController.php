<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function show(Request $request){
        $users=User::paginate(6);
        $data=compact('users');
        return view('admin/manage-users')->with($data);
    }

    public function pagination(Request $request){
        $page=$request['page'];
        $users=User::paginate(6);
        return response()->json(['users' => $users,'pagination'=>$users->links()->toHtml()]);
    }

    public function find(Request $request){
        $id=$request['id'];
        $user=User::find($id);
        return response()->json(['user'=>$user]);
    }

    public function add(Request $request){
        $user=User::where('username', $request['username'])->first();
        
        if($user){
            return response()->json(['errors' => ['username' => 'This username is taken']], 422); 
        }
        
        $user=new User();
        $user->username=$request['username'];
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->phone=$request['phone'];
        $user->gender=$request['gender'];
        $user->role=$request['role'];
        $user->password=bcrypt($request['password']);
        $user->photo="default.jpg";

        $user->save();

        return response()->json(['user'=>$user]);
    }

    public function update(Request $request){
        $id=$request['id'];
        $user=Auth::user();
        if($user && $user->role=='admin'){
            User::where('id',$id)
                    ->update($request->only(['name','email','phone','gender','role']));
            $user=User::where('id',$id)
                    ->first();
            return response()->json(['user'=>$user]);
        }
        
    }

    public function delete(Request $request){
        $id=$request['id'];
        $user=Auth::user();
        if($user && $user->role=='admin'){
            User::where('id',$id)
                    ->delete();
            return $id;
        }
        
    }


}
