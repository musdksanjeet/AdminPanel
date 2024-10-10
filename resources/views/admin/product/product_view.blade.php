@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
         
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
               <div class="card card-primary">
                   <div class="card-header">
                     <h3 class="card-title">View Product</h3>
                     <a href="{{url('admin/products')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Products</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          <th>Product Name</th>
                          <td>
                              {{$productdata->product_name}} 
                           </td>
                           <th>Category Name</th>
                          <td>{{$productdata->category->category_name}} </td>
                       </tr>
                       <tr>
                          <th>Product URL</th>
                          <td>{{$productdata->product_url}}</td>
                           <th>Brand Name</th>
                          <td>{{$productdata->brand->brand_name}}</td>
                       </tr>
                       <tr>
                          <th>Product Quantity</th>
                          <td>{{$productdata->quantity}}</td>
                           <th>Product Price</th>
                          <td>₹ {{$productdata->product_price}}</td>
                       </tr>
                       <tr>
                          <th>Product Discount</th>
                          <td>{{$productdata->product_discount}}</td>
                           <th>Discount Type</th>
                          <td>{{$productdata->discount_type}}</td>
                       </tr>
                       <tr>
                          <th>Product Code</th>
                          <td>{{$productdata->product_code}}</td>
                           <th>Product Color</th>
                          <td>{{$productdata->product_color}}</td>
                       </tr>                      
                       <tr>
                          <th>Product Wash Care</th>
                          <td>{{$productdata->wash_care}}</td>
                           <th>Product Keywords</th>
                          <td>{{$productdata->keywords}}</td>
                       </tr>
                       <tr>
                          <th>Family Color</th>
                          <td>{{$productdata->family_colors}}</td>
                           <th>Group Code</th>
                          <td>{{$productdata->group_code}}</td>
                       </tr>
                        
                        <tr>
                          <th>Product Pattern</th>
                          <td>{{$productdata->pattern}}</td>
                          <th>Is Featured</th>
                          <td>{{$productdata->is_featured}}</td>
                           
                       </tr>
                       <tr>
                          <th>Final Price</th>
                          <td>₹ {{$productdata->final_price}}</td>                       
                           <th>Product Weight</th>
                          <td>{{$productdata->product_weight}}</td>   
                       </tr>
                       <tr>
                          <th>Meta Title</th>
                          <td>{{$productdata->meta_title}}</td>
                           <th>Meta Description</th>
                          <td>{{$productdata->meta_description}}</td>
                       </tr>
                       <tr>
                          <th>Meta Keyword</th>
                          <td>{{$productdata->meta_keyword}}</td>
                           <th>Product Status</th>
                          <td>
                            @if($productdata['status'] == 1)
                                 <a class="updateProductStatus" id="page-{{$productdata['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                 <a class="updateProductStatus" id="page-{{$productdata['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>
                       </tr>
                        <tr>
                          <th>IS Featured</th>
                          <td>{{($productdata->is_featured)}}</td>

                          <th>Product Video</th>
                          <td>
                              <video width="240" height="120" controls autoplay muted loop>
                                   <source src="{{url('front/video/product/'.$productdata->product_video)}}" type="video/mp4">                                                                     
                              </video>
                           </td>

                       </tr> 
                     
                       <tr>
                          <th>Description</th>
                          <td colspan="3">{{strip_tags($productdata->description)}}</td>
                       </tr> 

                    </tbody>
                 </table>                                
               </div>

               <!-- Images-->
               <div class="card card-secondary">
                   <div class="card-header">
                     <h3 class="card-title">Product Image</h3>
                  </div>
                  <table class="table table-bordered">
                    <tbody>
                     @if(!empty($productdata->images) && $productdata->images->isNotEmpty())
                        <tr>
                          <th>Product Image</th>
                          <th>Product Sort Order</th>
                          <th>Image Created At</th>
                          <th>Product status</th>                         
                       </tr>
                       
                       @foreach($productdata->images as $image)
                       <tr>
                          <td><img src="{{ asset('front/images/products/small/' . $image->image) }}" height="30px" width="30px"></td>
                          <td>{{$image->image_sort}}</td> 
                          <td>{{date('F j, Y', strtotime($image->created_at))}}</td>  
                          <td>
                            @if($image->status==1)
                                <a class="updateProductImageeStatus" id="page-{{$image->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                <a class="updateProductImageeStatus" id="page-{{$image->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>                              
                       </tr>
                       @endforeach
                       @endif
                    </tbody>
                 </table>
               </div>
               <!-- End Images -->


               <!-- Attributes -->
               <div class="card card-secondary">
                   <div class="card-header">
                     <h3 class="card-title">Product Attributes</h3>
                  </div>
                  <table class="table table-bordered">
                    <tbody>
                     @if(!empty($productdata->attributes) && $productdata->attributes->isNotEmpty())
                        <tr>
                          <th>Product Size</th>
                          <th>Product SKU</th>
                          <th>Product Price</th>
                          <th>Product Stock</th>
                          <th>Product Staus</th>
                       </tr>
                       
                       @foreach($productdata->attributes as $attribute)
                       <tr>
                          <td>{{$attribute->size}}</td>
                          <td>{{$attribute->SKU}}</td>
                          <td>{{$attribute->price}}</td>
                          <td>{{$attribute->stock}}</td>
                          <td>
                            @if($attribute->status==1)
                                <a class="updateProductAttributeStatus" id="page-{{$attribute->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                <a class="updateProductAttributeStatus" id="page-{{$attribute->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>                              
                       </tr>
                       @endforeach
                       @endif
                    </tbody>
                 </table>
               </div>
               <!-- End Attributes -->

            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection
