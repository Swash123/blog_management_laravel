<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function show(){
        $user=Auth::user();
        if($user!=null && $user->role=='admin'){
            return redirect()->route('admin.index');
        }
        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
            DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->selectRaw('(engagements.likes + engagements.views + engagements.comments) AS total_interactions')
        ->groupBy('blogs.blog_id')
        ->orderByDesc('total_interactions')
        ->orderByDesc('blogs.updated_at')
        ->paginate(6);

        foreach ($blogs as $blog) {
            $blog->readable = Carbon::now()->subSeconds($blog->difference)->diffForHumans();
        }

        $data=compact('blogs');
        return view('index')->with($data);
    }

    public function more(Request $request){
        $page=$request['page'];
        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
        DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->selectRaw('(engagements.likes + engagements.views + engagements.comments) AS total_interactions')
        ->groupBy('blogs.blog_id')
        ->orderByDesc('total_interactions')
        ->orderByDesc('blogs.updated_at')
        ->paginate(6, ['*'], 'page', $page);

        foreach ($blogs as $blog) {
            $blog->readable = Carbon::now()->subSeconds($blog->difference)->diffForHumans();
        }

        return response()->json(['blogs'=>$blogs]);
    }

}