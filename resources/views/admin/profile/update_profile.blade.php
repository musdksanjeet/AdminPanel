@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Profile</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Update Profile</li>
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
                     <h3 class="card-title">Update Profile</h3>
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

                  <form action="{{url('admin/update-profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="form-group">
                           <label for="admin_email">Email address</label>
                           <input type="email" class="form-control" id="admin_email" value="{{Auth::guard('admin')->user()->email}}" readonly>
                        </div>
                        
                        <div class="form-group">
                           <label for="name">Name</label>
                           <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{Auth::guard('admin')->user()->name}}">
                        </div>  

                         <div class="form-group">
                           <label for="mobile">Mobile</label>
                           <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" value="{{Auth::guard('admin')->user()->mobile}}">
                        </div> 

                        <div class="form-group">
                           <label for="image">Photos</label>
                           <input type="file" name="image" class="form-control" id="image" placeholder="Update Image">                        
                           @if(!empty(Auth::guard('admin')->user()->image)) 
                           <a target="_blank" href="{{url('admin/images/photos'.'/'.Auth::guard('admin')->user()->image)}}">View Photo </a>
                           <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image}}">
                           @endif
                        </div> 

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end">Update Profile</button>
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