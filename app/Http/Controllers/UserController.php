<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.allusers')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role'  =>  'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if(Auth::user()->role === 0 ){
          $user = new User;
          $user->name = $request->input('name');
          $user->email = $request->input('email');
          $user->role = $request->input('role');
          $user->banned = false;
          $user->password = bcrypt($request->input('password'));
          $user->save();
        }else{
            return redirect()->back()->with('error_message','unauthorized');
        }
        return redirect()->route('users.index')->with('success_message','user was successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(Auth::user()->id == $user->id){
           return redirect()->back()->with('error_message','this operation cannot be peformed');
        }
        if(Auth::user()->role == 0 && Auth::user()->id !== $user->id){
            $user->delete();
        }
        return redirect()->back()->with('success_message','user was deleted successfully');
    }
}
