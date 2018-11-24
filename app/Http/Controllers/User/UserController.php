<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User ;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    // public function index(User $users)
    // {
    //     // $users = User::all();
    //     return $this->showAll($users);
    // }
 
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
        $rule = [
            'name' => 'required' ,
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ] ;

        $this->validate($request ,$rule );

        $data = $request->all();
        $data['password']= bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] =User::generateVerificationCode();
        $data['admin']=User::REGULAR_USER;

        $users = User::create($data);
    //verifed and admin option is available
       return $this->showOne($users,201);


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $users = User::findOrFail($id);
        return $this->showOne($user);
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
        $users = User::findOrFail($id);
        $rule = [
            'email' => 'email|unique:users,email,' . $users->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER ,
        ] ;

        if($request->has('name')){
            $users->name = $request->name ;
        }

        if($request->has('email') && $users->email != $request->email ){
            $users->verfied = User::UNVERIFIED_USER ;
            $users->verification_token = User::generateVerificationCode();
            $users->email = $request->email ;
        }

        if($request->has('passowrd'))
        {
            $users->password = bycrypt($request->password) ;
        }

        if($request->has('admin')){
            if(!$users->isVerified()){
            //    return response()->json(['error'=>'Only verified users can log in ! ','code'=>409],409);
            return $this->errorResponse('Only verified users can log in ! ',409);
            }
            $users->admin = $request->admin ;
        }

        // if($users->isDirty()){
        //     //return response()->json(['error'=>'Assign different value !','code'=>422],422);
           //return $this->errorResponse('Assign different value !',422);
        // }


        $users->save();
        return $this->showOne($users);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return $this->showOne($users);
    }
}

