<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');
    }

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfull',
            'alert-type' => 'info'
        );

        return redirect('/admin/login')->with($notification);
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData= User::find($id);

        return view('admin.admin_profile_view',compact('profileData'));

    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data= User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            // @unlink(public_path('upload/admin_images'.$data->photo));
            $fileName= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$fileName);
            $data['photo']= $fileName;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

    public function AdminChangePassword(){

        $id = Auth::user()->id;
        $profileData= User::find($id);

        return view('admin.admin_change_password',compact('profileData'));
        
    }

    public function AdminPasswordUpdate(Request $request){

        //Validate
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        /// Match The Old Password
        if(!Hash::check($request->old_password,Auth::user()->password)){
            $notification = array(
                'message' => 'Old Password is not matched',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        ///Update New Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
