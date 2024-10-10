@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Product List</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Product List</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">               
                <h3 class="card-title">Category</h3>
                  @if($ProductModule['edit_access']==1 || $ProductModule['full_access']==1)   
                  <a href="{{url('admin/create-product')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add New Product  </a> 
                  @endif
               </div>
              <!-- /.card-header -->
              <div class="card-body">

               <table id="productList" class="table table-bordered table-hover">
                 <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Code</th>   
                    <th>Category Name</th>   
                    <th>Parent Category</th>                   
                    <th>Price</th>  
                    <th>Quantity</th>   
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @php $i=1; @endphp
                      @foreach($productdata as $product)
                    <tr>                    
                      <td>{{$i++}}</td>
                      <td>{{$product['product_name']}}</td>
                      <td>{{ $product['product_code'] }}</td>
                      <td>{{ $product['category']['category_name'] }}</td>
                      <td>
                        @if(isset($product['category']['parent_category']['category_name']))
                            {{ $product['category']['parent_category']['category_name'] }}
                        @endif
                      </td>
                      <td>₹ {{$product['product_price']}}</td>
                      <td>{{$product['quantity']}}</td>
                      <td>
                        @if($ProductModule['edit_access']==1 || $ProductModule['full_access']==1)
                        @if($product['status']==1)
                          <a class="updateProductStatus" id="page-{{$product['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                        @else
                          <a class="updateProductStatus" id="page-{{$product['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                        @endif
                        @endif
                      </td>                      
                      <td>
                          @if($ProductModule['edit_access']==1 || $ProductModule['full_access']==1)
                          <a title="View" class="view btn btn-sm btn-info" href="{{url('admin/product-view/'.$product['id'])}}"> <i class="fa fa-eye"></i></a>

                          <a title="Edit" class="update btn btn-sm btn-warning" href="{{url('admin/product-edit/'.$product['id'])}}"> <i class="fa fa-wrench"></i></a>
                          @endif
                          
                          @if($ProductModule['full_access']==1)                        
                          <a title="Delete" class="delete btn btn-sm btn-danger confirmProductDelete" href="javascript:void(0)" recordid="{{$product['id']}}"><i class="fa fa-trash" aria-hidden="true"></i></a>    
                          @endif                      
                      </td>                      
                    </tr>
                    @endforeach
                  </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>

 </div>
@endsection
