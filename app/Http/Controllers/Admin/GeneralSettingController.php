<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Str;
use Session;
use validator;
use Auth;
use Image;

class GeneralSettingController extends Controller
{
    
    public function index()
    {
        Session::put('page','general_setting');
        $generalRecord = GeneralSetting::get();
        $title ="General Setting";
        return view('admin.generalSetting.general_list')->with(compact(['title','generalRecord']));

    }

    public function create()
    {
       
        $title ="General Setting Add";
        return view('admin.generalSetting.general_add')->with(compact(['title']));
    }
    
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();
            $rules = array(
                'website_name' => 'required',
                'website_url'  => 'required',
                );

            $this->validate($request,$rules);

             // Insert favicon
            if($request->hasfile('favicon'))
            {
                $favicon_tmp = $request->file('favicon');
                if($favicon_tmp->isValid())
                {
                    $extension = $favicon_tmp->getClientOriginalExtension();
                    $faviconname = rand(111,9999).'.'.$extension;
                    $image_path= 'front/images/logo/'.$faviconname;       
                    Image::make($favicon_tmp)->save($image_path);
                } 
            }else{
                $faviconname = "";
            }

             // Insert Logo
            if($request->hasfile('website_logo'))
            {
                $logo_tmp = $request->file('website_logo');
                if($logo_tmp->isValid())
                {
                    $extension = $logo_tmp->getClientOriginalExtension();
                    $logoname = rand(111,9999).'.'.$extension;
                    $image_path= 'front/images/logo/'.$logoname;       
                    Image::make($logo_tmp)->save($image_path);
                } 
            }else{
                $logoname = "";
            }

            GeneralSetting::insert([
                'application_name' => $data['website_name'],
                'application_url'=> $data['website_url'],
                'website_email'=> $data['website_email'],
                'website_phone'=> $data['website_phone'],
                'website_address'=> $data['website_address'],
                'status'=> $data['status'],
                'favicon'=> $faviconname,
                'logo'=> $logoname,

                ]);
        return redirect()->back()->with('success_message','General Setting added successfully!');
        }
    }

    public function storeLocal(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();

            $rules = array(
                'timezone' => 'required',
                'currency'  => 'required',
                );

            $this->validate($request,$rules);

            GeneralSetting::insert([
                'timezone' => $data['timezone'],
                'currency'=> $data['currency'],
                'vat'=> $data['website_vat'],
                'miles'=> $data['miles'],
                'prefix'=> $data['website_prefix'],
                'default_language'=> $data['language'],            

                ]);
         return redirect()->back()->with('success_message','Local Setting added successfully!');

        }
    }
   
    public function show($id)
    {
         $title = "View Setting";
         $viewRecord= GeneralSetting::find($id);
         return view('admin.generalSetting.general_view')->with(compact(['title','id','viewRecord']));  
    }
    
    public function edit($id)
    {
     $title = "Edit Setting";
     $editRecord= GeneralSetting::find($id);
     return view('admin.generalSetting.general_edit')->with(compact(['title','id','editRecord']));
    }

    
    public function update(Request $request, $id)
    {
       if($request->isMethod('post'))
        {
            $data = $request->all();
              // echo "<pre>";print_r($data);die();

            $setting = GeneralSetting::find($id);           
            $rules = array(
                'website_name' => 'required',
                'website_url'  => 'required',
                );

            $this->validate($request,$rules);

             // Insert favicon
             $faviconname = $setting->favicon;          
            if ($request->hasFile('favicon')) {
                $favicon_tmp = $request->file('favicon');
                if ($favicon_tmp->isValid()) {                  
                    if ($faviconname && file_exists(public_path('front/images/logo/' . $faviconname))) {
                        unlink(public_path('front/images/logo/' . $faviconname));
                    }
                   
                    $extension = $favicon_tmp->getClientOriginalExtension();
                    $faviconname = rand(111, 9999) . '.' . $extension;
                    $image_path = public_path('front/images/logo/' . $faviconname);
                    Image::make($favicon_tmp)->save($image_path);
                }
             }else{
                    $setting->favicon = "";
             }

             // Insert Logo
             $logoname = $setting->logo;          
            if ($request->hasFile('website_logo')) {
                $logo_tmp = $request->file('website_logo');
                if ($logo_tmp->isValid()) {                  
                    if ($logoname && file_exists(public_path('front/images/logo/' . $logoname))) {
                        unlink(public_path('front/images/logo/' . $logoname));
                    }
                   
                    $extension = $logo_tmp->getClientOriginalExtension();
                    $logoname = rand(111, 9999) . '.' . $extension;
                    $image_path = public_path('front/images/logo/' . $logoname);
                    Image::make($logo_tmp)->save($image_path);
                }
             }else{
                    $setting->logo = "";
             }

            GeneralSetting::where('id',$id)->update([
                'application_name' => $data['website_name'],
                'application_url'=> $data['website_url'],
                'website_email'=> $data['website_email'],
                'website_phone'=> $data['website_phone'],
                'website_address'=> $data['website_address'],
                'status'=> $data['status'],
                'favicon'=> $faviconname,
                'logo'=> $logoname,

                ]);
        return redirect()->back()->with('success_message','General Setting Update successfully!');
        }
    }

    public function updateLocal(Request $request, $id)
    {
        if($request->isMethod('post'))
         {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();

            $rules = array(
                'timezone' => 'required',
                'currency'  => 'required',
                );

            $this->validate($request,$rules);

            GeneralSetting::where('id',$id)->update([
                'timezone' => $data['timezone'],
                'currency'=> $data['currency'],
                'vat'=> $data['website_vat'],
                'miles'=> $data['miles'],
                'prefix'=> $data['website_prefix'],
                'default_language'=> $data['language'],            

                ]);
         return redirect()->back()->with('success_message','Local Setting Update successfully!');

        }
    }

   
    public function destroy($id)
    {
       $data =GeneralSetting::find($id);

       if(!$data)
       {
        return redirect()->back()->with('error_message', 'Setting not deleted successfully!');
       }else
       {
        $data->delete();
        return redirect()->back()->with('success_message', 'Setting deleted successfully!');

       } 
    }

    public function updateGeneralStatus(Request $request)
    {
        if($request->ajax())
        {
            $data =$request->all();

            if($data['status']=='active')
            {
                $status = 0;
            }
            else
            {
                $status =1;
            }
            GeneralSetting::where('id',$data['setting_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'setting_id'=>$data['setting_id']]);
        }
    }


}
