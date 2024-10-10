<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\AdminsRole;

use Session;
use Auth;
use validator;
use Image; 

class BrandController extends Controller
{
    
    public function index()
    {
        Session::put('page','Brand');        
        $brandRecord=Brand::get()->toArray();
        
        // Roles and Permissions
        $BrandModulesCount= AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'brand_page'])->count();
    
        $brandModule =array();

        if(Auth::guard('admin')->user()->type=='admin'){
            $brandModule['view_access'] = 1;
            $brandModule['edit_access'] = 1;
            $brandModule['full_access'] = 1;
        }else if($BrandModulesCount==0)
        {
            $message ="This featured is restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $brandModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'brand_page'])->first()->toArray();
        } 


        $title= "Brand List";
        return view('admin.brands.brand_list')->with(compact(['title','brandRecord','brandModule']));
    }

    
    public function create()
    {
        $title = 'Add Brand';
        return view('admin.brands.brand_add')->with(compact(['title']));
    }

    
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // dd($data);

            $rules =array(                
                'brand_name'         =>'required',
                'brand_url'          =>'required',  
            );

            $this->validate($request,$rules);

            // Insert Image
            if($request->hasfile('image'))
            {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename = rand(111,9999).'.'.$extension;
                    $image_path= 'front/images/brands/'.$imagename;       
                    Image::make($image_tmp)->save($image_path);
                } 
            }else{
                $imagename = "";
            }

            Brand::insert([
                        'brand_name' => $data['brand_name'],
                        'brand_slug' => $data['brand_url'],
                        'image'      => $imagename,
                        'status'     => $data['brand_status'],
                        'created_at' =>now(),
                        'updated_at' =>now(),
                    ]);

            return redirect()->back()->with('success_message','Brand added successfully!');            
        }
    }

    public function show($id)
    {
       $bradndRecord = Brand::find($id); 
       $title="View Brands";
       return view('admin.brands.brand_view')->with(compact(['title','id','bradndRecord']));
    }

   
    public function edit($id)
    {
        $title = 'Brand Edit';
        $bradndRecord = Brand::find($id);
        return view('admin.brands.brand_edit')->with(compact(['title','id','bradndRecord']));
    }

    public function update(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            
            $data = $request->all();
            $brand = Brand::find($id);
            // dd($data);

            $rules =array(                
                'brand_name'         =>'required',
                'brand_url'          =>'required',  
            );

            $this->validate($request,$rules);

            // Insert Image
            $imagename = $brand->image;          
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {                  
                    if ($imagename && file_exists(public_path('front/images/brands/' . $imagename))) {
                        unlink(public_path('front/images/brands/' . $imagename));
                    }
                   
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename = rand(111, 9999) . '.' . $extension;
                    $image_path = public_path('front/images/brands/' . $imagename);
                    Image::make($image_tmp)->save($image_path);
                }
             }else{
                    $brand->image = "";
             }

            Brand::where('id',$id)->update([
                        'brand_name' => $data['brand_name'],
                        'brand_slug' => $data['brand_url'],
                        'image'      => $imagename,
                        'status'     => $data['brand_status'],                        
                        'updated_at' =>now(),
                    ]);

            return redirect()->back()->with('success_message','Brand Updated successfully!');            
        }
    }

    public function destroy($id)
    {
       $data= Brand::find($id);
       if(!$data)
       {
         return redirect()->back()->with('error_message', 'Brand not deleted successfully!');
       }
       else
       {
         $data->delete();
         return redirect()->back()->with('success_message', 'Brand deleted successfully!');
       }
    }


    public function updateBrandStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();

            if($data['status']=='active')
            {
                $status=0;
            }else{
                $status=1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }
}
