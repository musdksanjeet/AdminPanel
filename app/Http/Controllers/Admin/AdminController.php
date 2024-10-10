<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use validator;
use Hash;
use Image;
use Session;

class AdminController extends Controller
{
    //Dashboard Page
    public function dashboard()
    {   Session::put('page','dashboard');
        $CategoryCount = Category::where(['parent_id'=>0])->get()->count();
        $ProductCount = Product::get()->count(); 
        $title='Dashboard';          
        return view('admin.dashboard')->with(compact(['title','CategoryCount','ProductCount']));
    }

    // Login Page
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data=$request->all();

            $rules= array(
                'email' => 'required|email|max:255',
                'password'=> 'required|max:30',
                );
            $customMessage=array(
                'email.required'=>'Email is Required!',
                'email.email'=> 'Valid email is Required!',
                'password.required'=>'Password is Required!',

            );

            $this->validate($request,$rules,$customMessage);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                
                // Remember checked admin and password with cookies 
                if(isset($data['remember']) && !empty($data['remember'])){
                    setcookie("email",$data['email'],time()+3600);
                    setcookie("password",$data['password'],time()+3600);                    
                }else{
                    setcookie("email","");
                    setcookie("password","");        
                }
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message',"Invalid Email or Password Id!");
            }
        }
        $title = "Login Page";
        return view('admin.login',['title'=>$title]);
    }

    // Register Page
    public function register(Request $request)
    {
         if($request->isMethod('post'))
        {
            $data=$request->all();

            $rules= array(
                'name' => 'required',
                'email' => 'required|email|max:255',
                'mobile'=>  'required|max:10',
                'password'=> 'required|min:6|max:30',
                );
            $customMessage=array(
                'name.required'=>'Name is Required!',
                'email.required'=>'Email is Required!',
                'email.email'=> 'Valid email is Required!',
                'mobile.required'=>'Mobile is Required!',
                'password.required'=>'Password is Required!',
                'password.min' => 'Password must be at least 6 characters long!'

            );

            $this->validate($request,$rules,$customMessage);

            // $admin = new Admin();
            // $admin->name = $data['name'];
            // $admin->type = 'admin';
            // $admin->email = $data['email'];
            // $admin->mobile = $data['mobile'];            
            // $admin->password = bcrypt($data['password']);       
            // $admin->status='1';
            // $admin->save();

            Admin::insert(['name'=>$data['name'],'type'=>$data['type'],'email'=>$data['email'],'mobile'=>$data['mobile'],'password'=>bcrypt($data['password']),'status'=>'1']);

            return redirect()->back()->with('success_message', 'Registration successful! Please login.');
        }

       $title = "Registration Page";
       return view('admin.register',['title'=>$title]);
    }

    // Logout 
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }   

}
