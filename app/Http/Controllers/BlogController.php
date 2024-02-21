<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Engagement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //

    public function blogView(Request $request){
        $id=$request['id'];
        Engagement::where('blog_id',$id)
                ->update([
                    'views'=> DB::raw('views+1')
                ]);

        $interaction=DB::table('blogs')
                        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
                        ->where('blogs.blog_id',$id)
                        ->first();
        

        $data=compact('interaction');

        return $data;
    }

    public function blogPost(Request $request){
        $blog=new Blog();
        $engagement=new Engagement();
        $id=Auth::id();
        if($id!=null){
            $blog->user_id=$id;
            $blog->title=$request['title'];
            $blog->content=$request['content'];

            $path=null;

        
            if($request->hasFile('photo')){
                $dest="public/images/blogs";
                $photo=$request->file('photo');
                $path=$photo->getClientOriginalName();
                $request->file('photo')->storeAs($dest,$path);
            }
            

            $blog->photo=$path;
            $blog->save();


            $engagement->blog_id=$blog->id;
            $engagement->save();

            

            $newID=$blog->id;
            $newBlog=DB::table('users')
                        ->join('blogs','users.id','=','blogs.user_id')
                        ->leftJoin('engagements','blogs.blog_id','=','engagements.blog_id')
                        ->where('blogs.blog_id',$newID)
                        ->select('users.id','users.username','users.name','blogs.*','engagements.*',
                            DB::raw('TIMESTAMPDIFF(SECOND, blogs.updated_at, NOW()) as difference'))
                        ->first();


            
            $newBlog->readable = Carbon::now()->subSeconds($newBlog->difference)->diffForHumans();
            

            $data=compact('newBlog');
            return $data;
            
        }
    }

    public function blogFind(Request $request){
        $blog_id=$request['id'];
        $blog=Blog::where('blog_id',$blog_id)
                    ->first();
        $data=compact('blog');
        return $data;
    }

    public function blogUpdate(Request $request){
        $blog_id=$request['blog_id'];
        $title=$request['title'];
        $photo=$request['photo'];
        $content=$request['content'];

        

        $path=null;

        
        if($request->hasFile('photo')){
            $dest="public/images/blogs";
            $photo=$request->file('photo');
            $path=$photo->getClientOriginalName();
            $request->file('photo')->storeAs($dest,$path);
        }else{
            $path=$request['photoCopy'];
        }

        Blog::where('blog_id',$blog_id)
            ->update([ 
                'title'=>$title,
                'photo'=>$path,
                'content'=>$content
            ]);
        
        $editBlog=Blog::where('blog_id', $blog_id)
                        ->select('*',DB::raw('TIMESTAMPDIFF(SECOND, updated_at, NOW()) as difference'))
                        ->first();
        $editBlog->readable = Carbon::now()->subSeconds($editBlog->difference)->diffForHumans();
            

        $data=compact('editBlog');
        return $data;
    }

    public function blogDelete(Request $request){
        $id=$request['blog_id'];
        Engagement::where('blog_id',$id)
                ->delete();
        Like::where('blog_id',$id)
                ->delete();
        Comment::where('blog_id',$id)
                ->delete();
        Blog::where('blog_id',$id)
                ->delete();
        $data=compact('id');
        return $data;
    }

    public function blogSearch(Request $request){
        $query=$request['query'];
        $blogs=DB::table('users')
        ->join('blogs','users.id','=','blogs.user_id')
        ->where('blogs.title','like',"%{$query}%")
        ->select('users.id','users.name','blogs.*')
        ->groupBy('blogs.blog_id')
        ->paginate(7);

        return response()->json(['blogs'=>$blogs]);
    }


        public function blogLike(Request $request){
            $id=Auth::id();
            $blog_id=$request['id'];
            $liked=false;
            if($id!=null){
                $like=Like::where('user_id',$id)
                    ->where('blog_id',$blog_id)
                    ->first();
                if($like==null){
                    $likeNew=new Like();
                    $likeNew->blog_id=$blog_id;
                    $likeNew->user_id=$id;
                    $likeNew->save();

                    Engagement::where('blog_id',$blog_id)
                        ->update([
                            'likes'=> DB::raw('likes+1')
                        ]);

                    $liked=true;

                }else{
                    Like::where('user_id',$id)
                        ->where('blog_id',$blog_id)
                        ->delete();
                    Engagement::where('blog_id',$blog_id)
                        ->update([
                            'likes'=> DB::raw('likes-1')
                        ]);
                        
                    $liked=false;
                }


                $interaction=Engagement::where('blog_id',$blog_id)
                            ->first();

                $data=compact('liked','interaction');

                return $data;


            }else{

            }

        }


    


    public function commentFind(Request $request){
        $comment_id=$request['id'];
        $comment=DB::table('comments')
                ->join('users','comments.user_id','=','users.id')
                ->where('comments.id',$comment_id)
                ->select('comments.*','users.name')
                ->first();
        $data=compact('comment');
        return $data;
    }

    public function commentLoad(Request $request){
        $id=$request['id'];
        $page=$request['page'];
        $comments=DB::table('comments')
                        ->join('users','comments.user_id','=','users.id')
                        ->where('comments.blog_id',$id)
                        ->where('comments.replied_to',null)
                        ->select('comments.*','users.name',
                            DB::raw('TIMESTAMPDIFF(SECOND, comments.updated_at, NOW()) as difference'))
                        ->orderBy('comments.created_at')
                        ->paginate(5, ['*'], 'page', $page);
        foreach ($comments as $comment) {
            $comment->readable = Carbon::now()->subSeconds($comment->difference)->diffForHumans();
        }
        return response()->json(['comments' => $comments]);
    }


    public function commentAdd(Request $request){
        $blog_id=$request['id'];
        $message=$request['comment'];
        $id=Auth::id();

        if($id!=null){
            
            $comment=new Comment();
            $comment->user_id=$id;
            $comment->blog_id=$blog_id;
            $comment->comment=$message;
            $comment->save();

            Engagement::where('blog_id',$blog_id)
                ->update([
                    'comments'=> DB::raw('comments+1')
                ]);


            $comment=DB::table('comments')
                        ->join('users','comments.user_id','=','users.id')
                        ->where('comments.id',$comment->id)
                        ->select('comments.*','users.name',
                            DB::raw('TIMESTAMPDIFF(SECOND, comments.updated_at, NOW()) as difference'))
                        ->first();
            $comment->readable = Carbon::now()->subSeconds($comment->difference)->diffForHumans();
        return response()->json(['comment' => $comment]);
        }
    }
    
    
    // public function replyLoad(Request $request){
    //     $id=$request['id'];
    //     $page=$request['page'];
    //     $replies=DB::table('comments')
    //                     ->join('users','comments.user_id','=','users.id')
    //                     ->where('comments.replied_to',$id)
    //                     ->select('comments.*','users.name',
    //                         DB::raw('TIMESTAMPDIFF(SECOND, comments.updated_at, NOW()) as difference'))
    //                     ->paginate(4);
    //     foreach ($replies as $reply) {
    //         $reply->readable = Carbon::now()->subSeconds($reply->difference)->diffForHumans();
    //     }
    //     return response()->json(['replies' => $replies]);
    // }

    public function replyLoad(Request $request){
        $id=$request['id'];
        $page=$request['page'];
        $replies=DB::table('comments')
                        ->join('users','comments.user_id','=','users.id')
                        ->where('comments.replied_to',$id)
                        ->select('comments.*','users.name',
                            DB::raw('TIMESTAMPDIFF(SECOND, comments.updated_at, NOW()) as difference'))
                        ->orderBy('comments.created_at')
                        ->paginate(4, ['*'], 'page', $page);
        foreach ($replies as $reply) {
            $reply->readable = Carbon::now()->subSeconds($reply->difference)->diffForHumans();
        }
        return response()->json(['replies' => $replies]);
    }


    public function replyAdd(Request $request){
        $blog_id=$request['id'];
        $message=$request['reply'];
        $parentId=$request['parentId'];
        $id=Auth::id();

        if($id!=null){
            $reply=new Comment();
            $reply->user_id=$id;
            $reply->blog_id=$blog_id;
            $reply->comment=$message;
            $reply->replied_to=$parentId;
            $reply->save();

            Engagement::where('blog_id',$blog_id)
                ->update([
                    'comments'=> DB::raw('comments+1')
                ]);

            $reply=DB::table('comments')
                        ->join('users','comments.user_id','=','users.id')
                        ->where('comments.id',$reply->id)
                        ->select('comments.*','users.name',
                            DB::raw('TIMESTAMPDIFF(SECOND, comments.updated_at, NOW()) as difference'))
                        ->first();
            $reply->readable = Carbon::now()->subSeconds($reply->difference)->diffForHumans();
        return response()->json(['reply' => $reply]);
        }
    }
    

    
    public function ajaxCanupdate(Request $request){
        $user=Auth::user();
            $blogId=$request['id'];
            $author=DB::table('users')
                        ->join('blogs','users.id','=','blogs.user_id')
                        ->where('blogs.blog_id','=',$blogId)
                        ->select('users.id','users.username','users.name','blogs.*')
                        ->first();
            if($user){
                $result=$user->id==$author->id||$user->role=='admin';
            }else{
                $result= false;
            }
            $data=compact('result');
            return $data;
    }

    public function ajaxHasLiked(Request $request){
        $id=Auth::id();
        $blogId=$request['id'];
        if($id!=null){
            $isLiked=Like::where('user_id',$id)
                            ->where('blog_id',$blogId)
                            ->exists();
            $result= $isLiked;
        }else{
            $result= false;
        }
        $data=compact('result');
        return $data;
    }

    public function ajaxIsUser(Request $request){
        $user=Auth::user();
        $check=false;
        if($user!=null){
            $check=true;
        }
        $data=compact('check');
        return $data;

    }


    
}
