<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    //Registration
    public function registration(){
        return view('front.account.registration');
    }
    //Save a user
    public function processRegistration   (Request $request){

        $validator= validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:5|same:confirm_password',
            'confirm_password'=> 'required',

        ]);
        if ($validator->passes()){
            $user= new User();
            $user->name=$request-> input('name');
            $user->email=$request-> input('email');
            $user->password=Hash::make($request-> password);
            $user->save();
            session() -> flash('success','You have registered Successfully.');


            return  response () -> json ([
                'status' => true,
                'message' => 'You have registered successfully.',
                

            ]);

        } else {

            return  response () -> json ([
                'status' => false,
                'errors' => $validator -> errors()

            ]);
        }
    }
    ///log in
    public function login (){
        return view('front.account.login');

    }
}
