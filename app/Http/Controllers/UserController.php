<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    // create a user

    public function Register( Request $request ) {
        $validate = $request->validate( [
            'name'=>'required|min:4',
            'email'=>'required|unique:user',
            'password'=>'required|confirmed',
        ] );
        $name = $request->input( 'name' );
        $email = $request->input( 'email' );
        $password = $request->input( 'password' );

        User::insert( [
            'name'=>$name,
            'email'=>$email,
            'password'=>$password
        ] );
        $data = [
            'status'=>'success',
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'create'=>[
                'method' =>'POST',
                'href'=>'/user/create',
                'params'=>'name,email,password'
            ]
        ];
        $response = [
            'message'=>'user created successfully',
            'data'=>$data
        ];

        return response()->json( $response, 200 );
    }

    // getting all users

    public function Getusers() {
        User::all();
        $data = [
            'status'=>'success',
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'create'=>[
                'method' =>'GET',
                'href'=>'/users',
                'params'=>'name,email,password'
            ]
        ];
        $response = [
            'message'=>'user created successfully',
            'data'=>$data
        ];

        return response()->json( $response, 200 );

    }

    public function Update( Request $request, $id ) {
        $name = $request->input( 'name' );
        $email = $request->input( 'email' );
        $password = $request->input( 'password' );

        User::find( $id )->update( [
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'created_at'=>Carbon::now()
        ] );
        $data = [
            'status'=>'success',
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'create'=>[
                'method' =>'GET',
                'href'=>'/users',
                'params'=>'name,email,password'
            ]
        ];
        $response = [
            'message'=>'user created successfully',
            'data'=>$data
        ];

        return response()->json( $response, 200 );

    }

    public function Login( Request $request ) {
        if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ] ) ) {

            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');

        }  

    }
    public function Delete( Request $request,  $id) {
        User::find( $id )->delete();

    }
}

