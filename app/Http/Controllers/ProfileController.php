<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('index');
        }

        $data = compact('user');

        return view('profile-manage')->with($data);


    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('index');
        }

        User::where('id', $user->id)->update($request->only(['name','email','phone','gender']));

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        $user = Auth::user();
        
        if ($user == null) {
            return redirect()->route('index');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['current_password' => 'Incorrect password']], 422);
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request['password']),
        ]);
        $user=Auth::user();
        return compact('user');
        
    }
}
