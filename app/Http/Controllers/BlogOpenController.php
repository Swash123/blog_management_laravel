<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Engagement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BlogOpenController extends Controller
{
    public function show($id){
        Engagement::where('blog_id',$id)
                ->update([
                    'views'=> DB::raw('views+1')
                ]);
                        
        $blog=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
        ->where('blogs.blog_id',$id)
        ->select('users.id','users.username','users.name','blogs.*','engagements.views','engagements.likes','engagements.comments',
            DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
        ->groupBy('blogs.blog_id')
        ->first();

        $blog->readable = Carbon::now()->subSeconds($blog->difference)->diffForHumans();
            

        $comments=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')
        ->where('comments.blog_id',$id)
        ->where('comments.replied_to',null)
        ->select('comments.*','users.name',
            DB::raw('TIMESTAMPDIFF(SECOND, comments.updated_at, NOW()) as difference'))
        ->orderBy('comments.created_at')
        ->paginate(5);

        foreach ($comments as $comment) {
            $comment->readable = Carbon::now()->subSeconds($comment->difference)->diffForHumans();
            $temp=Comment::find($comment->id);
            $comment->replies=$temp->countChildren();
        }
        
        $checkMore=$comments->currentPage()<$comments->lastPage();

        $data=compact('id','blog','comments','checkMore');
        return view('blogopen')->with($data);
    }
}
