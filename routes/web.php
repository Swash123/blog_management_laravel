<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ForyouController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogOpenController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\BlogsViewController;
use App\Http\Controllers\BlogWriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class,'show'])->name('index');
Route::get('/blogs', [BlogsViewController::class,'show'])->name('blogs');
Route::get('/blogs/trend', [TrendingController::class,'show'])->name('trend');
Route::get('/blogs/for-you', [ForyouController::class,'show'])->name('for_you');
Route::get('/profile', [ProfileController::class,'show'])->name('profile');



Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login', [LoginController::class,'auth'])->name('auth');
Route::post('/register', [LoginController::class,'register'])->name('register');



Route::get('/logout', [LoginController::class,'logout'])->name('logout');

Route::post('/profile/update', [ProfileController::class,'update'])->name('profile.update');
Route::post('/profile/changePassword', [ProfileController::class,'changePassword'])->name('password.change');



Route::post('/blogs/more', [BlogsViewController::class,'more'])->name('blogs.more');
Route::post('/blogs/trend/more', [TrendingController::class,'more'])->name('blogs.trend.more');
Route::post('/blogs/for-yor/more', [ForyouController::class,'more'])->name('blogs.foryou.more');
Route::post('/blogs/index/more', [IndexController::class,'more'])->name('blogs.index.more');

Route::post('/blogs/ajaxIsUser', [BlogController::class,'ajaxIsUser'])->name('blogs.ajax-isUser');
Route::post('/blogs/ajaxCanUpdate', [BlogController::class,'ajaxCanupdate'])->name('blogs.ajax-canUpdate');
Route::post('/blogs/ajaxHasLiked', [BlogController::class,'ajaxHasLiked'])->name('blogs.ajax-hasLiked');

Route::post('/blogs/find', [BlogController::class,'blogFind'])->name('blog.find');
Route::post('/blogs/post',[BlogController::class,'blogPost'])->name('blog.post');
Route::post('/blogs/update',[BlogController::class,'blogUpdate'])->name('blog.update');
Route::post('/blogs/delete',[BlogController::class,'blogDelete'])->name('blog.delete');
Route::post('/blogs/search',[BlogController::class,'blogSearch'])->name('blog.search');
Route::post('/blogs/view',[BlogController::class,'blogView'])->name('blog.view');
Route::post('/blogs/like',[BlogController::class,'blogLike'])->name('blog.like');
Route::post('/blogs/load-comment',[BlogController::class,'commentLoad'])->name('comment.load');
Route::post('/blogs/find-comment',[BlogController::class,'commentFind'])->name('comment.find');
Route::post('/blogs/add-comment',[BlogController::class,'commentAdd'])->name('comment.add');
Route::post('/blogs/load-reply',[BlogController::class,'replyLoad'])->name('reply.load');
Route::post('/blogs/add-reply',[BlogController::class,'replyAdd'])->name('reply.add');



Route::get('/blog/{id}',[BlogOpenController::class,'show'])->name('blog.show-content');


//admin
Route::get('/admin',[AdminController::class,'show'])->name('admin.index');
Route::get('/admin/users',[UsersController::class,'show'])->name('admin.users');
Route::get('/admin/write-blog', [BlogWriteController::class,'show'])->name('admin.write');
Route::get('/admin/blogs', [BlogsViewController::class,'show'])->name('admin.blogs');
Route::get('/admin/blogs/trend', [TrendingController::class,'show'])->name('admin.trend');
Route::get('/admin/profile', [ProfileController::class,'show'])->name('admin.profile');

Route::post('/users/pagination',[UsersController::class,'pagination'])->name('users.paginate');
