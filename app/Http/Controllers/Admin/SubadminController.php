<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminsRole;
use Illuminate\Support\Str;
use Auth;
use validator;
use Session;
use Hash;

class SubadminController extends Controller
{
    public function index()
    {
        Session::put('page','subadmin');
        $subadmins = Admin::where('type','subadmin')->get();
        $title='Subdomains Pages';
        return view('admin.subadmins.subadmin_list')->with(compact(['subadmins','title']));
    }
    public function create()
    {
      $title = 'Add SubAdmins';
      return view('admin.subadmins.subadmin_add');
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        { 
            $data=$request->all();

            $rules=array(
                'name'           =>    'required',
                'type'           =>    'required',
                'email'          =>    'required',
                'mobile'         =>    'required',
                'password'       =>    'required|min:6',
                'status'         =>    'required',                    
                );

           $this->validate($request,$rules);       
           

           Admin::insert(['name'=>$data['name'],'type'=>$data['type'],'email'=>$data['email'],'mobile'=>$data['mobile'],'password'=>Hash::make($data['password']),'status'=>$data['status'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);

           return redirect()->back()->with('success_message','Information data added successfully!');
        }
    }

    public function edit($id)
    {
        $editSibadmins=Admin::find($id); 
        $title = 'Edit Subdomains';
        return view('admin.subadmins.subadmin_edit',['title'=>$title,'SibadminsEdit'=>$editSibadmins]);
    }

    public function update(Request $request,$id)
    {
     if($request->isMethod('post'))
        {
            $data=$request->all();

             $rules=array(
                'name'           =>    'required',
                'type'           =>    'required',
                'email'          =>    'required',
                'mobile'         =>    'required',
                // 'password'       =>    'required|min:6',
                'status'         =>    'required',                    
                );

           $this->validate($request,$rules);       
           // Find the record
            $subadmins = Admin::find($id);

            if (!$subadmins) {
                return redirect()->back()->with('error_message', 'Page not found.');
            }

        // Update the record
            $subadmins->update([
                'name'              => $data['name'],
                'type'              => $data['type'],
                // 'email'             => $data['email'],
                'mobile'            => $data['mobile'],
                'status'            => $data['status'],
                'updated_at'        => date('Y-m-d H:i:s'),
                
            ]);

        return redirect()->back()->with('success_message', 'Information data updated successfully!');
       } 
    }


    public function updateSubadminStatus(Request $request)
    {
        if($request->ajax())
        {
             $data= $request->all();
        if($data['status']=='active')
        {
            $status=0;
        }else
        {
            $status=1;
        }
        Admin::where('id',$data['subadmins_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'subadmins_id'=>$data['subadmins_id']]);
      }
    }

    public function destroy($id)
    {
        $data = Admin::find($id);       
        if (!$data) {
            return redirect()->back()->with('error_message', 'Subdomains not deleted successfully!');
        }else{       
            $data->delete();
            return redirect()->back()->with('success_message', 'Subdomains deleted successfully!');
        }
    }

    public function updateRole(Request $request,$id){
        if($request->isMethod('post'))
        {
            $data = $request->all();  
              // echo "<pre>";print_r($data);die();

            // Delete all Earlier Roles 
            AdminsRole::where('subadmin_id',$id)->delete();

            // Add New Roles for subadmins dynamically
            $rolesToInsert = [];            
            
            foreach($data as $key=>$value)
            {
                if ($key === '_token' || $key === 'subadmin_id') {                
                    continue;
                }
                if(isset($value['view']))
                {
                    $view = $value['view'];
                }else{
                    $view =0;
                }
                if(isset($value['edit']))
                {
                    $edit = $value['edit'];
                }else{
                    $edit =0;
                }
                if(isset($value['full']))
                {
                    $full = $value['full'];
                }else{
                    $full =0;
                }

                $rolesToInsert[] = [ 
                    'subadmin_id' => $id,
                    'module' => $key,                   
                    'view_access' => $view,
                    'edit_access' => $edit,
                    'full_access' => $full,
                ];
            }           

            AdminsRole::insert($rolesToInsert);

            $subadminsdetails = Admin::where('id',$id)->first()->toArray();
            $message = "Role and Permissions Updated successfully!";
            return redirect()->back()->with('success_message',$message);

        }

        $subadminsRoles= AdminsRole::where('subadmin_id',$id)->get()->toArray();   
        $subadminsdetails = Admin::where('id',$id)->first()->toArray();
        $title = "Update Role and Permissions";

        return view('admin.subadmins.update_role',compact(['title','id','subadminsRoles','subadminsdetails']));
    }



}
