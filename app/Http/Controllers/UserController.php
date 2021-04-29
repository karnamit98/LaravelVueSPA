<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  // dd(User::all());
        return User::orderBy('created_at','DESC')->get();
      // return "Index Reached!";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  // return "show user controller reached! recieved id:".$id;
        $result = User::findOrFail($id);
        return  $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // return "Edit User Controller Reached!";
        return User::findOrFail($id);
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],// 'unique:users'],
           // 'role' => ['required', 'tinyint'],    //already gets validated result from option
           // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $avatar = "https://i.pravatar.cc/40?u=".$request['email'];
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->avatar = $avatar;
        $user->role = $request['role'];
        $user->save();
           // $user->password = Hash::make($request['password']),
        //return "Successfully changed email to ".$request['email']." !Old: ".$user->email;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return "Successfully deleted user with id".$id;
    }
}
