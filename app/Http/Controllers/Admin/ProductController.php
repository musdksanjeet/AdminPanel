<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductsAttribute;
use App\Models\AdminsRole;
use Session;
use Auth;
use validator;
use Hash;
use Image;



class ProductController extends Controller
{
   
    public function index()
    {
        Session::put('page','Product');
        $productdata = Product::with('category')->get()->toArray(); 
        
        $ProductModulesCount= AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'product_page'])->count();
    
        $ProductModule =array();

        if(Auth::guard('admin')->user()->type=='admin'){
            $ProductModule['view_access'] = 1;
            $ProductModule['edit_access'] = 1;
            $ProductModule['full_access'] = 1;
        }else if($ProductModulesCount==0)
        {
            $message ="This featured is restricted for you";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $ProductModule = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'product_page'])->first()->toArray();
        }   

        $title='Product Page';
        return view('admin.product.product_list')->with(compact(['title','productdata','ProductModule']));
    }
    
    public function create()
    {
       $productdata = Product::with('category')->get()->toArray();  
       $productBrand = Brand::get();     
       $title = 'Add Product';
       return view('admin.product.product_add')->with(compact(['title','productdata','productBrand']));
    }

    
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
         // echo "<pre>";print_r($data);die();
            
            $rules =array(                
                'product_name'         =>'required',
                'product_url'          =>'required',
                'product_quantity'     =>'required',   
                'product_code'         =>  'required',
                'product_price'        =>'required',   
                'status'               =>  'required',
            );

            $this->validate($request,$rules);   

            // Calculation for final Price
           $final_price = $data['product_price'];
            if (!empty($data['product_price'])) {
                if (!empty($data['discount_type'])) {
                    if ($data['discount_type'] == 'fixed') {
                        $final_price -= $data['product_discount'];
                    } elseif ($data['discount_type'] == 'percentage') {
                        $final_price -= ($data['product_price'] * $data['product_discount']) / 100;
                    }
                }
            }

           // Insert Video
            if($request->hasfile('product_video'))
            {
                $video_tmp = $request->file('product_video'); 
                if($video_tmp->isValid())
                {
                    $videoname = $video_tmp->getClientOriginalName();                     
                    $video_tmp->move(public_path('front/video/product'), $videoname);
                } 
            }else{
                $videoname = "";
            }     


            $productId = Product::insertGetId([
                        'product_name'          => $data['product_name'],
                        'category_id'           => 1,
                        'brand_id'              => $data['brand_id'],
                        'product_url'           => $data['product_url'],
                        'quantity'              => $data['product_quantity'],
                        'product_code'          => $data['product_code'],
                        'product_color'         => $data['product_color'],
                        'family_colors'         => implode(',',$data['family_colors']), // Check 
                        'group_code'            => $data['group_code'],
                        'product_price'         => $data['product_price'],
                        'product_discount'      => $data['product_discount'],
                        'discount_type'         => $data['discount_type'],
                        'final_price'           => $final_price,
                        'description'           =>$data['description'],
                        'product_weight'        => $data['product_weight'],
                        'product_video'         => $videoname,
                        'wash_care'             => $data['wash_care'],
                        'keywords'              => $data['product_keywords'],
                        'pattern'               => $data['pattern'],
                        'meta_title'            => $data['meta_title'],
                        'meta_description'      => $data['meta_description'],
                        'meta_keyword'          => $data['meta_keyword'],
                        'is_featured'           => $data['is_featured'], 
                        'status'                => $data['status'],
                        'created_at'            =>now(),
                        'updated_at'            =>now(),                    
                    ]); 


            
                
            // Insert Images 
               if ($request->hasFile('product_images')) {
                $images = $request->file('product_images');
                $image_sort = 1; 
                foreach ($images as $image) {
                    if ($image->isValid()) {                        
                        $imageName = $image->getClientOriginalName();
                        $large_image_path  =  'front/images/products/large/'.$imageName;
                        $medium_image_path =  'front/images/products/medium/'.$imageName;
                        $small_image_path  =  'front/images/products/small/'.$imageName;

                        // Resize Images
                        Image::make($image)->save($large_image_path);
                        Image::make($image)->resize(600,600)->save($medium_image_path);
                        Image::make($image)->resize(300,300)->save($small_image_path);                      

                        ProductImage::updateOrCreate([
                            'product_id' => $productId,//Get the Last ID 
                            'image'      => $imageName,
                            'image_sort' => $image_sort++,
                            'status'     => 1, 
                        ]);
                    }
                 }
            }

            // Product Attributes
                if (!empty($data['size'])) {
                    foreach ($data['size'] as $key => $size) {
                        if (!empty($size)) {                           
                            ProductsAttribute::updateOrCreate(
                                [
                                    'product_id' =>$productId,
                                    'size' => $size,
                                    'SKU' => $data['sku'][$key], 
                                    'price' => $data['price'][$key],
                                    'stock' => $data['stock'][$key],
                                    'status' => 1,
                                ],                               
                            );
                        }
                    }
                }



           return redirect()->back()->with('success_message','Product added successfully!');    
            
        }
    }

    
    public function show($id)
    {
       $productdata=Product::with(['category','brand','attributes','images'])->find($id); 
        // dd($productdata);
       $productImage = ProductImage::where('product_id', $id)->get();
       $title = "Product view";
       return view('admin.product.product_view')->with(compact(['title','id','productdata','productImage']));
    }

    
    public function edit($id)
    {        
        $productdata=Product::with(['category','brand','attributes'])->find($id);
        $productBrand = Brand::get();      
        $title = "Product Edit";
        return view('admin.product.product_edit')->with(compact(['title','id','productdata','productBrand']));
    }
    
    public function update(Request $request, $id)
    {
       if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error_message', 'Product not found!');
            }
            
            $rules =array(                
                'product_name'         =>'required',
                'product_url'          =>'required',
                'product_quantity'     =>'required',   
                'product_code'         =>'required',
                'product_price'        =>'required',   
                'status'               =>'required',
            );

            $this->validate($request,$rules);   

            // Update Final Price  
           $final_price = $data['product_price'];
            if (!empty($data['product_price'])) {
                if (!empty($data['discount_type'])) {
                    if ($data['discount_type'] == 'fixed') {
                        $final_price -= $data['product_discount'];
                    } elseif ($data['discount_type'] == 'percentage') {
                        $final_price -= ($data['product_price'] * $data['product_discount']) / 100;
                    }
                }
            }


            // Update Video 
            $videoname = $product->product_video; 
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {    
                    $videoname = $video_tmp->getClientOriginalName();     
                    if (file_exists(public_path('front/video/product/' . $videoname))) {
                         unlink(public_path('front/video/product/' . $videoname));
                    }               
                    $video_tmp->move(public_path('front/video/product'), $videoname);
                }
             }else{
                    $product->product_video = "";
             }

            
            Product::where('id',$id)->update([
                    'product_name'          => $data['product_name'],
                    'category_id'           => 1,
                    'brand_id'              => $data['brand_id'],
                    'product_url'           => $data['product_url'],
                    'quantity'              => $data['product_quantity'],
                    'product_code'          => $data['product_code'],
                    'product_color'         => $data['product_color'],
                    'family_colors'         => implode(',',$data['family_colors']), // Check 
                    'group_code'            => $data['group_code'],
                    'product_price'         => $data['product_price'],
                    'product_discount'      => $data['product_discount'],
                    'discount_type'         => $data['discount_type'],
                    'final_price'           => $final_price,
                    'description'           => $data['description'],
                    'product_weight'        => $data['product_weight'],
                    'product_video'         => $videoname,
                    'wash_care'             => $data['wash_care'],
                    'keywords'              => $data['product_keywords'],
                    'pattern'               => $data['pattern'],
                    'meta_title'            => $data['meta_title'],
                    'meta_description'      => $data['meta_description'],
                    'meta_keyword'          => $data['meta_keyword'],
                    'is_featured'           => $data['is_featured'], 
                    'status'                => $data['status'],                    
                    'updated_at'            => now(),                    
                ]);


            // Update Image 
            if ($request->hasFile('product_images'))
            {
                $images = $request->file('product_images');
                $image_sort = 1;
                foreach ($images as $image)
                {
                  
                    if ($image->isValid()) 
                    { 
                        $imageName = $image->getClientOriginalName(); 
                        if(file_exists(public_path('front/images/products/').$imageName))
                        {
                            unlink(public_path('front/images/products/').$imageName);
                        }                        
                        $image->move(public_path('front/images/products'), $imageName);                        

                        ProductImage::updateOrCreate([
                                'product_id' => $product->id,
                                'image' => $imageName,
                                'image_sort' => $image_sort++,
                                'status' => 1,
                            ]);                  
                    }
                }
            }

             // Product Attributes
                if (!empty($data['size'])) {
                    foreach ($data['size'] as $key => $size) {
                        if (!empty($size)) {
                            ProductsAttribute::updateOrCreate(
                                [
                                    'product_id' => DB::getPdo()->lastInsertId(),
                                    'size' => $size,
                                    'SKU' => $data['sku'][$key], 
                                    'price' => $data['price'][$key],
                                    'stock' => $data['stock'][$key],
                                    'status' => 1,
                                ],                               
                            );
                        }
                    }
                }

           return redirect()->back()->with('success_message','Product Updated successfully!');    
            
        }
    }

    public function destroy($id)
    {
       $product=Product::find($id);    
       if(!$id){
            return redirect()->back()->with('error_message', 'Product not deleted successfully!');
       }
        $images = ProductImage::where('product_id', $id)->get();
        foreach ($images as $image) {            
            $imagePath = public_path('front/images/products/' . $image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }           
            $image->delete();
        }        
        $product->delete();

        return redirect()->back()->with('success_message', 'Product deleted successfully!');
    }

    public function updateProductStatus(Request $request){
        if($request->ajax())
        {
            $data= $request->all();
            if($data['status']=='active')
            {
                $status=0;

            }else{
                $status=1;
            }
        Product::where('id',$data['product_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
      }
    }

    public function updateProductAttrStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            if($data['status']=='active')
            {
                $status =0;

            }else{
                $status=1;
            }

            ProductsAttribute::where('id',$data['productattr_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'productattr_id'=>$data['productattr_id']]);
        }        
    }

    public function updateProductImgStatus(Request $request)
    {
         if($request->ajax())
        {
            $data = $request->all();
            if($data['status']=='active')
            {
                $status =0;

            }else{
                $status=1;
            }

            ProductImage::where('id',$data['productimg_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'productimg_id'=>$data['productimg_id']]);
        }        
    }

}
