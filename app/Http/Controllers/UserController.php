<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }//End Method


    public function userProfile(){

        $id = Auth::user()->id;
        $data = User::find($id);

        return view('frontend.dashboard.userProfile_edit',compact('data'));

    }//End Method

    public function userProfileUpdate(Request $request){
        $id = Auth::user()->id;
        $data= User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/').$data->photo);
            $fileName = date('ymdhmi').$file->getClientOriginalName();

            $file->move(public_path('upload/user_images'),$fileName);
            $data['photo'] = $fileName;
        }
        $data->save();

        $notification = array(
            'message' => "Your Data Has Been Successfully Updated!",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//End Method


    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfull',
            'alert-type' => 'info'
        );

        return redirect('/login')->with($notification);
    }//End Method

    public function userPasswordChange(){
        return view('frontend.dashboard.password_change');
    }//End Method

    public function userPasswordUpdate(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password,Auth::User()->password)){
            $notification = array(
                'message' => "Your Old Pasword Is Not Matched!",
                'alert-type' => 'danger'
            );

            return back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => "Your Password Has Been Successfully Updated!",
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }//End Method
}
