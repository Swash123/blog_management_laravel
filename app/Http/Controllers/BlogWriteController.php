<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogWriteController extends Controller
{
    public function show(){
        return view('admin/write-blog');
    }
}
