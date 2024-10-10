<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPages;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use validator;
use Auth;



class InformationController extends Controller
{
    public function index()
    {
        Session::put('page','information');
        $pages=CmsPages::get()->toArray();
        $InfoPagesModulesCount= AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'information_pages'])->count();
    
        $pagesModule =array();

        if(Auth::guard('admin')->user()->type=='admin'){
            $pagesModule['view_access'] = 1;
            $pagesModule['edit_access'] = 1;
            $pagesModule['full_access'] = 1;
        }else if($InfoPagesModulesCount==0)
        {
            $message ="This featured is restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $pagesModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'information_pages'])->first()->toArray();
        }

        $title='Information Page';
        return view('admin/information/list')->with(compact('title','pages','pagesModule'));
    }

   
    public function create()
    {
      $title = 'Add Information';
      return view('admin.information.add');
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data=$request->all();

            $rules=array(
                'title'         =>    'required',
                'url'           =>    'required',
                'description'   =>    'required',
                'meta_title'    =>    'required',
                'meta_desc'     =>    'required',
                'meta_keyword'  =>    'required',     
                'status'        =>    'required',    
                );

           $this->validate($request,$rules);       
           

           CmsPages::insert(['title'=>$data['title'],'url'=>$data['url'],'description'=>$data['description'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_desc'],'meta_keyword'=>$data['meta_keyword'],'status'=>$data['status'],'sort_order'=>0]);

           return redirect()->back()->with('success_message','Information data added successfully!');
        }
    }
   
    public function show($id)
    {      
       $viewPage=CmsPages::find($id);           
       $title= 'Show Information';
       return view('admin.information.view',['title'=>$title,'page'=>$viewPage]);
    }

    
    public function edit($id)
    {
        $editPage=CmsPages::find($id); 
        $title = 'Edit Information';
        return view('admin.information.edit',['title'=>$title,'infoedit'=>$editPage]);
    }

    public function update(Request $request,$id)
    {
     if($request->isMethod('post'))
        {
            $data=$request->all();

            $rules=array(
                'title'         =>    'required',
                'url'           =>    'required',
                'description'   =>    'required',
                'meta_title'    =>    'required',
                'meta_desc'     =>    'required',
                'meta_keyword'  =>    'required',     
                'status'        =>    'required',    
                );

           $this->validate($request,$rules);       
           // Find the record
            $cmsPage = CmsPages::find($id);

            if (!$cmsPage) {
                return redirect()->back()->with('error_message', 'Page not found.');
            }

        // Update the record
            $cmsPage->update([
                'title'             => $data['title'],
                'url'               => $data['url'],
                'description'       => $data['description'],
                'meta_title'        => $data['meta_title'],
                'meta_description'  => $data['meta_desc'],
                'meta_keyword'      => $data['meta_keyword'],
                'status'            => $data['status'],
                'sort_order'        => 0
            ]);

        return redirect()->back()->with('success_message', 'Information data updated successfully!');
       } 
    }

   
    public function destroy($id)
    {
        $data = CmsPages::find($id);       
        if (!$data) {
            return redirect()->back()->with('error_message', 'Information page not deleted successfully!');
        }else{       
            $data->delete();
            return redirect()->back()->with('success_message', 'Information page deleted successfully!');
        }
    }

    public function updateCmsPageStatus(Request $request)
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
        CmsPages::where('id',$data['page_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
      }
    }

   
}
