<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Hash;
use Auth;
use Session;

class UserController extends Controller
{
    public function insert(Request $request){
        {
           try{
                $validator = Validator::make($request->all(),[
                    'name' => 'required|min:4',
                    'email' => 'required|email',
                    'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' =>'min:6',               
                ]);
                if ($validator->fails()) {
                    $error    = $validator->errors()->toArray();
                    $firstKey = array_key_first($error);
                    $err_data = $error[$firstKey];
                    
                    return redirect()->back()->with([
                        'status' => 'error', 'message' => $err_data[0],
                    ]);
                } else {
                    
                        $user = new User;
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->roll_id = 1;
                        $user->password = Hash::make($request->password);
                        $user->created_at = Carbon::now();
    
                        if ($user->save()) {
                        return redirect()->route('home')->with(array('status'=>'error','msg'=>'Admin added successfully'));
                        } else {
                            return redirect()->back(array('status'=>'error','msg'=>'Admin Not saved'));
                        }
                 
                }
            }
            catch(\Exception $e){
                return response()->json(array('status'=>'error','msg'=>$e->getMessage()));
            }
       }
    }

    public function login(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            Session::put('user',$data['email']);
            request()->session()->flash('success','You are successfully logged in');
            return redirect()->route('dashboard');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return redirect()->route('home');
    }
}
