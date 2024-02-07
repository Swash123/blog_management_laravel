<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

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
}
