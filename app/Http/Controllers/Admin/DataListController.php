<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DataList;
use App\Models\AdminsRole;
use Session;
use validator;
use Auth;


class DataListController extends Controller
{
    
    public function index()
    {
        Session::put('page','data-list');
        $datalistRecords = DataList::get(); 

        // Roles and Permissions
        $DataListModulesCount= AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'datalist_page'])->count();
    
        $dataListModule =array();

        if(Auth::guard('admin')->user()->type=='admin'){
            $dataListModule['view_access'] = 1;
            $dataListModule['edit_access'] = 1;
            $dataListModule['full_access'] = 1;
        }else if($DataListModulesCount==0)
        {
            $message ="This featured is restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $dataListModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'datalist_page'])->first()->toArray();
        }


        $title = "DataList Page";
        return view('admin.datalist.datalists')->with(compact('title','datalistRecords','dataListModule'));
    }
  
    public function create()
    {
      $dataListFields = DataList::select('field_name', DB::raw('MAX(list_id) + 1 AS newid'))
       ->groupBy('field_name')->get()->toArray();
       // dd($dataListFields);
      $title = "DataList Add";
      return view('admin.datalist.datalist_add')->with(compact('title','dataListFields'));
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $rules = array(
              "datalist_type"   => "required",
              "field_name"      => "required",
              "list_id"         => "required",
              "value"           => "required",
              "datalist_status" => "required" , 
            );

            $this->validate($request, $rules);

            DataList::insert([                
                "field_name"      => $data['field_name'],
                "list_id"         => $data['list_id'],
                "value"           => $data['value'],
                "status"          => $data['datalist_status'],
                "created_at"      => now(),
                "updated_at"      => now(),  

            ]);

           return redirect()->back()->with('success_message','DataList added successfully!');
        }
    }


    public function show($id)
    {
      $datalistRecords = DataList::find($id);
      $title = "DataList View";
      return view('admin.datalist.datalist_view')->with(compact('title','datalistRecords'));
    }

   
    public function edit($id)
    {
      $datalistRecords = DataList::find($id);
      $title = "DataList View";
      return view('admin.datalist.datalist_edit')->with(compact('title','datalistRecords'));
    }

 
    public function update(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $rules = array( 
              "field_name"      => "required",
              "list_id"         => "required",
              "value"           => "required",
              "datalist_status" => "required" , 
            );

            $this->validate($request, $rules);

            DataList::where('id',$id)->update([                
                "field_name"      => $data['field_name'],
                "list_id"         => $data['list_id'],
                "value"           => $data['value'],
                "status"          => $data['datalist_status'],
                "created_at"      => now(),
                "updated_at"      => now(),  

            ]);

           return redirect()->back()->with('success_message','DataList Updated successfully!');
        }
    }

    
    public function destroy($id)
    {
        $data = DataList::find($id);

        if(!$data)
        {
            return redirect()->back()->with('error_message', 'DataList not deleted successfully!');

        }else{
            $data->delete();
            return redirect()->back()->with('success_message', 'DataList deleted successfully!');
        }

    }

    public function updateDataListStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            if($data['status'] == 'active')
            {
                $status = 0;
            }else{

                $status = 1;
            }
            DataList::where('id',$data['datalist_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'datalist_id'=>$data['datalist_id']]);            
        }
    }
}
