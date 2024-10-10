<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use validator;
use Hash;
use Image;
use Session;

class ProfileController extends Controller
{
   // updateProfile
    public function updateProfile(Request $request)
    {
        Session::put('page','update-profile');
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $rules= array(
                'name' => 'required|max:255',
                'mobile'=> 'required|max:10',
                'image' => 'image',
                );

            // $customMessage=array(
            //     'name.required'=>'Name is Required!',
            //     'mobile.required'=> 'Mobile is Required!',
            //     'mobile.max'=>'Mobile number must be at least 12 number long!',

            // );
            $this->validate($request,$rules);
            // Upload Admin Images 
            if($request->hasfile('image'))
            {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename = rand(111,9999).'.'.$extension;
                    $image_path= 'admin/images/photos/'.$imagename;       
                    Image::make($image_tmp)->save($image_path);
                } 
            }else if(!empty($data['current_image']))
            {
                $imagename=$data['current_image'];
            }else{
                $imagename = "";
            }


            // Update Admin details 
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'image'=>$imagename]);
            return redirect()->back()->with('success_message','Update Profile details has been Updated successful!');        
        }
        $title = "Update profile";
        return view('admin.profile.update_profile',['title'=>$title]);
    }


    // Update Password 
    public function updatePassword(Request $request)
    {
        Session::put('page','update-password');
        if($request->isMethod('post'))
        {
            $data=$request->all();       
            // Check current password
            if(Hash::check($data['curr_pass'],Auth::guard('admin')->user()->password))
            {
                // New and confirm password is match!
                if($data['new_pass']==$data['conf_pass'])
                {
                    // Update the New Password
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pass'])]);
                    return redirect()->back()->with('success_message','Password has been Updated successful!');
                }else{
                    return redirect()->back()->with('error_message','New Password and Confirm Password is not match!');
                }

            }else{
                return redirect()->back()->with('error_message','Current Password is Incorrect!');
            }


        }
        $title='Update Password';
        return view('admin.profile.change_password',['title'=>$title]);
    }


// checkCurrentPassword
    public function checkCurrentPassword(Request $request){
        $data= $request->all();
        if(Hash::check($data['current_pass'],Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }
    
}
