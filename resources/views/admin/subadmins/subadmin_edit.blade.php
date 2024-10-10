@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Add SubAdmins</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add SubAdmins</li>
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
                     <h3 class="card-title">Add SubAdmins</h3>
                     <a href="{{url('admin/subadmins')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List subadmins</a>
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

                  <form action="{{ url('admin/update-subadmin/' . $SibadminsEdit->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6">
                         <div class="form-group">
                                 <label for="name">Name</label>
                                 <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{$SibadminsEdit->name}}">
                              </div>
                         </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="type">Type</label>
                          <select class="form-control" name="type" id="type">
                             <option>===Select Type===</option>
                             <option value="subadmin" {{ $SibadminsEdit->type == 'subadmin' ? 'selected' : '' }}>Subadmin</option>           
                        </select>
                        </div>                              
                        </div>  

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="email" value="{{$SibadminsEdit->email}}" readonly>
                        </div>      
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="mobile">Mobile</label>
                           <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile Number" value="{{$SibadminsEdit->mobile}}">
                        </div>                              
                        </div>

                        <!-- <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_desc">Password</label>
                           <input type="text" name="password" class="form-control" id="password" placeholder="Enter Password">
                        </div>                              
                        </div>   -->                      

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="status">Status</label>
                          <select class="form-control" name="status" id="status">
                             <option>===Select Status===</option>
                             <option value="1" {{ $SibadminsEdit->status == 1 ? 'selected' : '' }}>Active</option>
                             <option value="0" {{ $SibadminsEdit->status == 0 ? 'selected' : '' }}>Inactive</option>                          
                        </select>
                        </div>                              
                        </div>                

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Subadmins</button>
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