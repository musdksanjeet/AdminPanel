<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AdminsRole;
use Auth;
use validator;
use Hash;
use Image;
use Session;

class CategoryController extends Controller
{
   
    public function index()
    {
      Session::put('page','Category');
      $Categorydata = Category::with('parentCategory')->get()->toArray();   

      $CategoryModulesCount= AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'category_page'])->count();
    
        $categoryModule =array();

        if(Auth::guard('admin')->user()->type=='admin'){
            $categoryModule['view_access'] = 1;
            $categoryModule['edit_access'] = 1;
            $categoryModule['full_access'] = 1;
        }else if($CategoryModulesCount==0)
        {
            $message ="This featured is restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $categoryModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'category_page'])->first()->toArray();
        }   

      $title = 'Category List';
      return view('admin.category.category_list')->with(compact(['title','Categorydata','categoryModule']));

    }
    
    public function create()
    {
        $gatCategories = Category::getCategory(); 
        $title = 'Add Category';
        return view('admin.category.category_add')->with(compact(['gatCategories', 'title']));
        
    }

    
    public function store(Request $request)
    {        
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();
            $rules =array(                
                'category_name'         =>'required',
                'category_url'          =>'required',
                'category_discription'  =>'required',   
            );

            $this->validate($request,$rules);       
            
             if($request->hasfile('category_image'))
            {
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename = rand(111,9999).'.'.$extension;
                    $image_path= 'front/images/category/'.$imagename;       
                    Image::make($image_tmp)->save($image_path);
                } 
            }else{
                $imagename = "";
            }

           Category::insert([
                    'parent_id'=>$data['parent_id'] ?: 0,
                    'category_name'=>$data['category_name'],
                    'category_url'=>$data['category_url'],
                    'category_discount'=>$data['category_discount'],
                    'category_description'=>$data['category_discription'],
                    'category_meta_title'=>$data['category_meta_title'],
                    'category_meta_description'=>$data['category_meta_description'],
                    'category_meta_keyword'=>$data['category_meta_keyword'],                    
                    'category_status' => $data['category_status'] === '' ? 0 : $data['category_status'], 
                    'category_image' => $imagename,              
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]);

           return redirect()->back()->with('success_message','Category added successfully!');

        }       

    }

    public function show($id)
    {
          
        $category= Category::with('parentCategory')->find($id);
        $title = 'Category View';
        return view('admin.category.category_view')->with(compact(['title','id','category'])); 
    }

   
    public function edit($id)
    {     
        $gatCategories = Category::getCategory();
        $categoryRecord=Category::with('parentCategory')->find($id); 
        $title = 'Edit Category';
        return view('admin.category.category_edit')->with(compact(['title','categoryRecord','id','gatCategories'])); 
    }

    public function update(Request $request, $id)
    {
       if($request->isMethod('post'))
       {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->back()->with('error_message', 'Category not found!');
            }

            $data = $request->all();
            // echo "<pre>";print_r($data);die();
            $rules =array(                
                'category_name'         =>'required',
                'category_url'          =>'required',
                'category_discription'  =>'required',   
            );

            $this->validate($request,$rules);

            $imagename = $category->category_image;          
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {                  
                    if ($imagename && file_exists(public_path('front/images/category/' . $imagename))) {
                        unlink(public_path('front/images/category/' . $imagename));
                    }
                   
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename = rand(111, 9999) . '.' . $extension;
                    $image_path = public_path('front/images/category/' . $imagename);
                    Image::make($image_tmp)->save($image_path);
                }
             }else{
                    $category->category_image = "";
             }

            Category::where('id',$id)->update([
                    'parent_id'=>$data['parent_id'] ?: 0,
                    'category_name'=>$data['category_name'],
                    'category_url'=>$data['category_url'],
                    'category_discount'=>$data['category_discount'],
                    'category_description'=>$data['category_discription'],
                    'category_meta_title'=>$data['category_meta_title'],
                    'category_meta_description'=>$data['category_meta_description'],
                    'category_meta_keyword'=>$data['category_meta_keyword'],
                    'category_status'=>$data['category_status'] === '' ? 0 : $data['category_status'],  
                    'category_image' => $imagename,
                    // 'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    ]);

           return redirect()->back()->with('success_message','Category Updated successfully!');
       }
    }

    public function destroy($id)
    {
        $data= Category::find($id);
        if(!$data){
            return redirect()->back()->with('error_message', 'Category not deleted successfully!');
        }else{
            $data->delete();
            return redirect()->back()->with('success_message', 'Category deleted successfully!');
        }
    }

    public function updateCategoryStatus(Request $request)
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
        Category::where('id',$data['category_id'])->update(['category_status'=>$status]);
        return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
      }
    }
}
