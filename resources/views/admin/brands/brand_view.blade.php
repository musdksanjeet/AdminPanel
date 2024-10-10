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
                     <h3 class="card-title">View Brand</h3>
                     <a href="{{url('admin/brands')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Brands</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          
                       <tr>
                          <th>Brand name</th>
                          <td>{{$bradndRecord->brand_name}}</td>
                          <th>Brand URL</th>
                          <td>{{$bradndRecord->brand_slug}}</td>
                           
                       </tr>  
                       <tr>
                           <th>Brand Image</th>
                           <td>
                              <img src="{{url('front/images/brands/'.$bradndRecord->image)}}"/ width="50px" height="50px">
                           </td>
                          <th>Category Satus</th>
                          <td>
                            @if($bradndRecord->status == 1)
                                 <a class="updateCategoryStatus" id="page-{{$bradndRecord->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                 <a class="updateCategoryStatus" id="page-{{$bradndRecord->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>
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
