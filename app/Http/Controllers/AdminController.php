<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function show(){
        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('likes','blogs.blog_id','=','likes.blog_id')
        ->select('users.id','users.username','users.name','blogs.*',DB::raw('count(likes.blog_id) AS likes'))
        ->groupBy('blogs.blog_id')
        ->paginate(20);

        $data=compact('blogs');
    return view('admin/index')->with($data);
    }
}
