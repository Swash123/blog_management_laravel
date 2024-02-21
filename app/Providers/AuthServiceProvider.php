<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('canUpdate', function ($user,$blogId) {
            
            $author=DB::table('users')
                    ->join('blogs','users.id','=','blogs.user_id')
                    ->where('blogs.blog_id','=',$blogId)
                    ->select('users.id','users.username','users.name','blogs.*')
                    ->first();
            return $user->id==$author->id||$user->role=='admin';
        });

        //

        Gate::define('isLiked',function($user,$blogId){
            $id=$user->id;
            $isLiked=Like::where('user_id',$id)
                            ->where('blog_id',$blogId)
                            ->exists();
            return $isLiked;
        });
    }
}
