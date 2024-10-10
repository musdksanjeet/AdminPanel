@extends('admin.layouts.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Edit Product</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Edit Product</li>
               </ol>
            </div>
            <!-- /.col -->
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
                     <h3 class="card-title">Edit Product</h3>
                     <a href="{{url('admin/products')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Products</a>
                  </div>
                  @if($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach 
                      </ul> 
                   </div>
                  @endif

                  @if(Session::has('error_message'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           {{Session::get('error_message')}}
                      <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                     </div>
                  @endif

                   @if(Session::has('success_message'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                           {{Session::get('success_message')}}
                      <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                     </div>
                  @endif

                  <form action="{{url('admin/update-product/'. $id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_name">Product Name</label>
                           <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="{{$productdata->product_name}}">                         
                        </div>                              
                        </div>  
                       <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">===Select Category===</option>                                   
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    <option value="">=== Select Brand ===</option>  
                                    @foreach($productBrand as $brand)
                                     <option value="{{ $brand->id }}" {{$productdata->brand->id == $brand->id ? 'selected' : ''}}>{{ $brand->brand_name }}</option>
                                    @endforeach                                    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_url">Product Url</label>
                           <input type="text" class="form-control" name="product_url" id="product_url" placeholder="Product Url" value="{{$productdata->product_url}}">
                        </div>      
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_quantity">Product Quantity</label>
                           <input type="text" name="product_quantity" class="form-control" id="product_quantity" placeholder="Product Quantity" value="{{$productdata->quantity}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_code">Product Code</label>
                           <input type="text" name="product_code" class="form-control" id="product_code" placeholder="Product Code" value="{{$productdata->product_code}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_color">Product Color</label>                           
                           <select name="product_color" class="form-control" id="product_color">
                              <option>=== Select Color ===</option>
                              <option value="red" {{$productdata->product_color=='red'?'selected':''}}>Red</option>
                              <option value="green" {{$productdata->product_color=='green'?'selected':''}}>Green</option>
                              <option value="blue" {{$productdata->product_color=='blue'?'selected':''}}>Blue</option>
                              <option value="yellow" {{$productdata->product_color=='yellow'?'selected':''}}>Yellow</option>
                           </select>
                        </div>                              
                        </div>
                        <div class="col-lg-6">
                         <div class="form-group">
                             <label for="family_colors">Family Colors</label>
                             <select class="form-control select2" name="family_colors[]" multiple="multiple">
                                 <option value="">=== Select Family Colors ===</option> 
                                 @php
                                     // Convert family_colors string to an array
                                     $selected_colors = explode(',', $productdata->family_colors);
                                 @endphp
                                 <option value="red" {{ in_array('red', $selected_colors) ? 'selected' : '' }}>Red</option>
                                 <option value="green" {{ in_array('green', $selected_colors) ? 'selected' : '' }}>Green</option>
                                 <option value="blue" {{ in_array('blue', $selected_colors) ? 'selected' : '' }}>Blue</option>
                                 <option value="yellow" {{ in_array('yellow', $selected_colors) ? 'selected' : '' }}>Yellow</option>
                             </select>
                         </div>
                     </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="group_code">Group Code</label>
                           <input type="text" name="group_code" class="form-control" id="group_code" placeholder="Group Code" value="{{$productdata->group_code}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="group_code">Product Price</label>
                           <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Product Price" value="{{$productdata->product_price}}">
                        </div>                              
                        </div>



                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_discount">Product Discount</label>
                           <input type="text" name="product_discount" class="form-control" id="product_discount" placeholder="Product Discount" value="{{$productdata->product_discount}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="discount_type">Discount Type</label>                           
                           <select name="discount_type" id="discount_type" class="form-control">
                              <option value="">=== Select Discount Type ===</option>
                              <option value="fixed" {{ $productdata->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                              <option value="percentage" {{ $productdata->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                           </select>
                        </div>                              
                        </div>

                        <div class="col-lg-12">
                        <div class="form-group">
                           <label for="group_code">Product Attributes</label>                          
                        <div class="field_wrapper">
                            @foreach($productdata->attributes as $attributes)
                                <input type="text" class="form-control" name="size[]" id="size" placeholder="Size" value="{{$attributes->size}}">&nbsp;
                                <input type="text" class="form-control" name="sku[]" id="sku" placeholder="SKU" value="{{$attributes->SKU}}">&nbsp;
                                <input type="text" class="form-control" name="price[]" id="price" placeholder="Price" value="{{$attributes->price}}">&nbsp;
                                <input type="text" class="form-control" name="stock[]" id="stock" placeholder="Stock" value="{{$attributes->stock}}">&nbsp;
                                <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add</a>
                                 @endforeach
                        </div>
                       
                        </div>
                       </div>

                        <div class="col-lg-12">
                        <div class="form-group">
                           <label for="description">Product Discription</label>
                           <textarea id= "summernote" name="description" class="form-control">{{$productdata->description}}</textarea>
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_weight">Product Weight</label>
                           <input type="text" name="product_weight" class="form-control" id="product_weight" placeholder="Product Weight" value="{{$productdata->product_weight}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="wash_care">Product Wash Care</label>
                           <input type="text" name="wash_care" class="form-control" id="wash_care" placeholder="Product Wash Care" value="{{$productdata->wash_care}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_keywords">Product Keywords</label>
                           <input type="text" name="product_keywords" class="form-control" id="product_keywords" placeholder="Product Keywords" value="{{$productdata->keywords}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="pattern">Product Pattern</label>
                           <input type="text" name="pattern" class="form-control" id="pattern" placeholder="Product Pattern" value="{{$productdata->pattern}}">
                        </div>                              
                        </div>                       

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_title">Product Meta Title</label>
                           <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Product Meta Title" value="{{$productdata->meta_title}}">
                        </div>                              
                        </div>                        

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_description">Meta Description</label>
                           <input type="text" name="meta_description" class="form-control" id="meta_description" placeholder="Product Meta Description" value="{{$productdata->meta_description}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_keyword">Product Meta Keyword</label>
                           <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Product Meta Keyword" value="{{$productdata->meta_keyword}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_video">product Video</label>
                           <input type="file" name="product_video" class="form-control" id="product_video" placeholder="Product Video">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="product_images">product Images</label>
                           <input type="file" name="product_images[]" class="form-control" id="product_images" placeholder="Product Images" multiple="">
                        </div>                              
                        </div>

                         <div class="col-lg-6">
                        <div class="form-group">
                           <label for="is_featured">Product Featured</label>
                           <select name="is_featured" class="form-control" id="is_featured">
                               <option value="">=== Select featured ===</option>
                               <option value="Yes" {{ $productdata->is_featured == 'Yes' ? 'selected' : '' }}>Yes</option>
                               <option value="No" {{ $productdata->is_featured == 'No' ? 'selected' : '' }}>No</option>
                           </select>
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="status">Product Status</label>
                           <select name="status" class="form-control" id="status">
                               <option value="">=== Select Status ===</option>
                               <option value="1" {{ $productdata->status == 1 ? 'selected' : '' }}>Active</option>
                               <option value="0" {{ $productdata->status == 0 ? 'selected' : '' }}>InActive</option>
                           </select>
                        </div>                              
                        </div> 
                               

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Product</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
        $('#product_name').on('keyup', function() {
            var product_name = $(this).val();           
            var product_url = product_name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
            $('#product_url').val(product_url);
        });

   // Select2 
        $('.select2').select2();
 
    });
</script>
