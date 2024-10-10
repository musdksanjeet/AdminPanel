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
                     <h3 class="card-title">View Category</h3>
                     <a href="{{url('admin/category')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Category</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          <th>Parent Id</th>
                          <td>
                              @if(isset($category->parentCategory) && $category->parentCategory->category_name)
                                {{$category->parentCategory->category_name}}                            
                            @endif   
                           </td>
                           <th>Category Name</th>
                          <td>{{$category->category_name}}</td>
                       </tr>
                       <tr>
                          <th>Category URL</th>
                          <td>{{$category->category_url}}</td>
                           <th>Category Discount</th>
                          <td>{{$category->category_discount}}</td>
                       </tr>
                        <tr>
                          <th>Category Meta Title</th>
                          <td>{{$category->category_meta_title}}</td>
                           <th>Category Meta Description</th>
                          <td>{{$category->category_meta_description}}</td>
                       </tr>
                       <tr>
                          <th>Category Meta Keyword</th>
                          <td>{{$category->category_meta_keyword}}</td>
                           <th>Category Satus</th>
                          <td>
                            @if($category['category_status'] == 1)
                                 <a class="updateCategoryStatus" id="page-{{$category['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                 <a class="updateCategoryStatus" id="page-{{$category['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>
                       </tr>
                       <tr>
                          <th>Created At</th>
                          <td>{{date('F j, Y',strtotime($category->created_at))}}</td>
                           <th>Category Image</th>
                          <td>
                              @if(isset($category->category_image))
                              <img src="{{url('admin/images/category/'.$category->category_image)}}" style="height: 40px;width: 40px;">
                           @endif
                        </td>
                       </tr>
                       <tr>
                          <th>Description</th>
                          <td colspan="3">{{strip_tags($category->category_description)}}</td>
                       </tr> 

                    </tbody>
                 </table>                                
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection
