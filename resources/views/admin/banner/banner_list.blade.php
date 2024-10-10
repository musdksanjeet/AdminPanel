@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Banner List</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Banner List</li>
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
                <h3 class="card-title">Banner</h3>   
                @if($bannerModule['edit_access']==1 || $bannerModule['full_access']==1)
                  <a href="{{url('admin/create-banner')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add New Banner  </a>
                @endif               
               </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table id="brandList" class="table table-bordered table-hover">
                 <thead>

                  <tr>
                    <th>Id</th>
                    <th>Banner Image</th>                 
                    <th>Banner Type</th>
                    <th>Banner Title</th>                    
                    <th>Banner Alt</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @foreach($bannerList as $banner)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>
                        <img src="{{url('front/images/banner/'.$banner->image)}}" height="40px" width="40px">
                      </td>
                      <td>{{ucfirst($banner->type)}}</td>
                      <td>{{$banner->title}}</td>
                      <td>{{$banner->alt}}</td>
                      <td>
                        @if($bannerModule['edit_access']==1 || $bannerModule['full_access']==1)
                         @if($banner->status == 1)
                             <a class="updateBannerStatus" id="page-{{$banner->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>  
                        @else                    
                              <a class="updateBannerStatus" id="page-{{$banner->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>                    
                       @endif
                       @endif
                      </td>
                      <td>
                        @if($bannerModule['edit_access']==1 || $bannerModule['full_access']==1)
                        <a title="View" class="view btn btn-sm btn-info" href="{{url('admin/banner-view/'.$banner->id)}}"> <i class="fa fa-eye"></i></a>

                        <a title="Edit" class="update btn btn-sm btn-warning" href="{{url('admin/banner-edit/'.$banner->id)}}"> <i class="fa fa-wrench"></i></a>
                        @endif
                        @if($bannerModule['full_access']==1)
                        <a title="Delete" class="delete btn btn-sm btn-danger confirmBannerDelete" href="javascript:void(0)" recordid="{{$banner->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
