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
                     <h3 class="card-title">View Banner</h3>
                     <a href="{{url('admin/banners')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Banner</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          
                       <tr>
                          <th>Banner Image</th>
                          <td>
                           <img src="{{url('front/images/banner/'.$bannerList->image)}}"/ width="50px" height="50px">
                          </td>
                          <th>Banner URL</th>
                          <td>{{$bannerList->link}}</td>
                           
                       </tr>  
                       <tr>
                           <th>Banner Type</th>
                           <td>{{$bannerList->type}}</td>
                           <th>Banner Title</th>
                           <td>{{$bannerList->title}}</td>                          
                       </tr>                   
                       <tr>
                           <th>Banner Alt</th>
                           <td>{{$bannerList->alt}}</td>
                          <th>Category Satus</th>
                          <td>
                            @if($bannerList->status == 1)
                                 <a class="updateBannerStatus" id="page-{{$bannerList->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                 <a class="updateBannerStatus" id="page-{{$bannerList->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>
                       </tr>
                       <tr>
                           <th>Banner Sort</th>
                           <td>{{$bannerList->sort}}</td>
                           <th>Banner CreatedAt</th>
                           <td>{{date('F j, Y',strtotime($bannerList->created_at))}}</td>                          
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
