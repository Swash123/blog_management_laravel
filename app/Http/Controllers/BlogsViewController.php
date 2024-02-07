<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BlogsViewController extends Controller
{
    //

    public function show(){
        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
                    DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->groupBy('blogs.blog_id')
        ->orderBy('blogs.updated_at','desc')
        ->paginate(4);
        foreach ($blogs as $blog) {
            $blog->readable = Carbon::now()->subSeconds($blog->difference)->diffForHumans();
        }

        $data=compact('blogs');
        return view('blogsview')->with($data);
    }

    public function more(Request $request){
        $page=$request['page'];
        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
            DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->groupBy('blogs.blog_id')
        ->orderBy('blogs.updated_at','desc')
        ->paginate(4, ['*'], 'page', $page);

        foreach ($blogs as $blog) {
            $blog->readable = Carbon::now()->subSeconds($blog->difference)->diffForHumans();
        }

        return response()->json(['blogs'=>$blogs]);
    }



}
