<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function User()
    {
        return view('users.users');
    }
    public function postRegister(Request $request)
    {
        $this->validate($request,[
            'password'=>'confirmed|required|min:5|max:10',
            'password_confirmation'=>'required|min:5|max:10',
            'email' =>'email|unique:users',
        ]);

        User::create($request->all());
        return back()->with(['success'=>'User '. $request->first_name.' created successfully']);
    }
    public function Users()
    {
        $users = User::paginate(10);
        return view('users.userInfo',compact('users'));
    }
    public function editUser(Request $request)
    {
        if ($request->ajax())
        {
            return response(User::find($request->id));
        }
    }
    public function updateUser(Request $request)
    {

        if ($request->ajax())
        {
            return response(User::updateOrCreate(['id'=>$request->id],$request->all()));
        }
    }
}
