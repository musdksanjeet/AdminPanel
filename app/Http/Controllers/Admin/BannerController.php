<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\AdminsRole;
use Session;
use Auth;
use validator;
use Image;

class BannerController extends Controller
{
   
    public function index()
    {
        Session::put('page','Banner');
        $bannerList = Banner::get();

         // Roles and Permissions
        $BannerModulesCount= AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'banner_page'])->count();
    
        $bannerModule =array();

        if(Auth::guard('admin')->user()->type=='admin'){
            $bannerModule['view_access'] = 1;
            $bannerModule['edit_access'] = 1;
            $bannerModule['full_access'] = 1;
        }else if($BannerModulesCount==0)
        {
            $message ="This featured is restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $bannerModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'banner_page'])->first()->toArray();
        }


        $title = "Banner List";
        return view('admin.banner.banner_list')->with(compact('title','bannerList','bannerModule'));
    }

   
    public function create()
    {            
      $title = 'Add Banner';
      return view('admin.banner.banner_add')->with(compact('title'));
    }
  
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data= $request->all();
            
            $rules = array(
              'banner_type' => 'required',
              'banner_link' => 'required',  
              'banner_title' => 'required',
              'banner_status' => 'required'
            );

            $this->validate($request,$rules);

            //Insert Banner Image
            if($request->hasfile('banner_image'))
            {
                $image_tmp = $request->file('banner_image');
                if($image_tmp->isValid())
                {
                    $bannerName = $image_tmp->getClientOriginalName();                   
                    $image_path= 'front/images/banner/'.$bannerName;       
                    Image::make($image_tmp)->save($image_path);
                } 
            }else{
                $bannerName = "";
            }

            // Insert the data in table 
            Banner::insert([
                'image' => $bannerName,
                'type'  => $data['banner_type'],
                'link'  => $data['banner_link'],
                'title'  => $data['banner_title'],
                'alt'  => $data['banner_alt'],
                'sort'  => $data['banner_order'],
                'status'   => $data['banner_status'],
                'created_at' =>now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success_message','Banner added successfully!');
        }
    }
    
    public function show($id)
    {
      $bannerList= Banner::find($id);          
      $title = 'View Banner';
      return view('admin.banner.banner_view')->with(compact('title','bannerList'));
    }

    public function edit($id)
    {
      $bannerList= Banner::find($id);          
      $title = 'Edit Banner';
      return view('admin.banner.banner_edit')->with(compact('title','bannerList'));
    }

   
    public function update(Request $request, $id)
    {
      if($request->isMethod('post'))
        {
            $data= $request->all();
            $banner = Banner::find($id);
            $rules = array(
              'banner_type' => 'required',
              'banner_link' => 'required',  
              'banner_title' => 'required',
              'banner_status' => 'required'
            );

            $this->validate($request,$rules);

            //Update Banner Image
             $bannerName = $banner->image;           
            if ($request->hasFile('banner_image')) {
                $image_tmp = $request->file('banner_image');

                if ($image_tmp->isValid()) {                
                    $oldImagePath = public_path('front/images/banner/') . $bannerName;

                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                    
                    $bannerName = $image_tmp->getClientOriginalName();
                    $image_path = 'front/images/banner/' . $bannerName;
                    Image::make($image_tmp)->save($image_path);
                }
            }

            // Insert the data in table 
            Banner::where('id',$id)->update([
                'image' => $bannerName,
                'type'  => $data['banner_type'],
                'link'  => $data['banner_link'],
                'title'  => $data['banner_title'],
                'alt'  => $data['banner_alt'],
                'sort'  => $data['banner_order'],
                'status'   => $data['banner_status'],                
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success_message','Banner Updated successfully!');
        }
    }

    public function destroy($id)
    {
       $data = Banner::find($id);
       if(!$data)
       {
         return redirect()->back()->with('error_message', 'Banner not deleted successfully!');
       }
       else
       {
         $data->delete();
         return redirect()->back()->with('success_message', 'Banner deleted successfully!');
       }
    }

    public function updateBannerStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            if($data['status']=='active')
            {
                $status =0;
            }else{

                $status =1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);

        }
    }

}
