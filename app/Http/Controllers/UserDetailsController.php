<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Userrole;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllUsers = User::all();
        $userDetails = [];
        foreach($getAllUsers as $user){
            $id = $user->id;
            $name = $user->name;
            $email = $user->email;
            $role = [];
            foreach($user->getroles as $dd) {
                $role[] = Role::find($dd->role_id)->role_name;
            }
            $userDetails[] = array('id'=>$id,'name' => $name, 'email' =>$email, 'roles' => $role);
        }
        return response()->json(array('status' => 'sucess', 'code' => 200, 'data' => $userDetails));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = '12333';
        $user->save();

        $role = new Userrole();
        $roleArray =$request->role;
        foreach ($roleArray as  $value) {
            DB::table('user_roles')->insert(['role_id' => $value, 'user_id' => $user->id]);
        }
        
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
        $getUser = User::find($id);
        $getUser->delete();
        return response()->json(array('status' => 'sucess', 'code' => 200));
    }

    /**
     * get roles.
     */
    public function getRoles()
    {
        $getAllRolls = Role::all();
        return response()->json(array('status' => 'sucess', 'code' => 200,'data' => $getAllRolls));
    }    
}
