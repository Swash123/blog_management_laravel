<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrendingController extends Controller
{
    //
    public function show(){
        $now = Carbon::now();
        $duration=$now->subDays(28)->toDateString();

        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->leftJoin(DB::raw('(SELECT blog_id, COUNT(*) AS like_count FROM likes WHERE created_at >= \'' . $duration . '\' GROUP BY blog_id) AS l'), 'blogs.blog_id', '=', 'l.blog_id')
        ->leftJoin(DB::raw('(SELECT blog_id, COUNT(*) AS comment_count FROM comments WHERE created_at >= \'' . $duration . '\' GROUP BY blog_id) AS c'), 'blogs.blog_id', '=', 'c.blog_id')
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
            DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->selectRaw('(COALESCE(l.like_count, 0) + COALESCE(c.comment_count, 0)) AS total_interactions')
        ->groupBy('blogs.blog_id')
        ->orderByDesc('total_interactions')
        ->orderByDesc('blogs.updated_at')
        ->paginate(4);

        foreach ($blogs as $blog) {
            $blog->readable = $now->subSeconds($blog->difference)->diffForHumans();
        }
        $data=compact('blogs');
        return view('trending')->with($data);
    }

    public function more(Request $request){
        $page=$request['page'];
        $now = Carbon::now();
        $duration=$now->subDays(28)->toDateString();

        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->leftJoin(DB::raw('(SELECT blog_id, COUNT(*) AS like_count FROM likes WHERE created_at >= \'' . $duration . '\' GROUP BY blog_id) AS l'), 'blogs.blog_id', '=', 'l.blog_id')
        ->leftJoin(DB::raw('(SELECT blog_id, COUNT(*) AS comment_count FROM comments WHERE created_at >= \'' . $duration . '\' GROUP BY blog_id) AS c'), 'blogs.blog_id', '=', 'c.blog_id')
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
            DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->selectRaw('(COALESCE(l.like_count, 0) + COALESCE(c.comment_count, 0)) AS total_interactions')
        ->groupBy('blogs.blog_id')
        ->orderByDesc('total_interactions')
        ->orderByDesc('blogs.updated_at')
        ->paginate(4, ['*'], 'page', $page);


        foreach ($blogs as $blog) {
            $blog->readable = $now->subSeconds($blog->difference)->diffForHumans();
        }
        return response()->json(['blogs'=>$blogs]);
    }

}
