<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class PasswrodChangeController extends Controller
{
    public function index(){
        return view('admin.profile.password_change.index');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'old_password'  => 'required',
            'password'      => 'required|confirmed|min:6',
        ]);

        $current_pass   = Auth::user('admin')->password;
        $old_pass       = $request->old_password;
        
        if( Hash::check($old_pass, $current_pass) ){
            $admin = Admin::findOrFail(Auth::id());
            $admin->password = Hash::make( $request->password );
            $admin->save();
            Auth::logout();   
            $notification = array('message'=>'Password Change Successfully.', 'alert-type'=>'success');
            return redirect()->route('admin.login')->with($notification);         
        }else{
            $notification = array('message'=>'Doesn\'t match old password.', 'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }
}
