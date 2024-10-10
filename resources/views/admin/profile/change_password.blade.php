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
                  <li class="breadcrumb-item active">Update Password</li>
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
                     <h3 class="card-title">Update Password</h3>
                  </div>
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

                  <form action="{{url('admin/update-password')}}" method="post">
                    @csrf
                     <div class="card-body">
                        <div class="form-group">
                           <label for="admin_email">Email address</label>
                           <input type="email" class="form-control" id="admin_email" value="{{Auth::guard('admin')->user()->email}}" readonly>
                        </div>
                        
                        <div class="form-group">
                           <label for="curr_pass">Current Password</label>
                           <input type="password" name="curr_pass" class="form-control" id="curr_pass" placeholder="Current Password"><span id="verify_curr_pass"></span>
                        </div>  

                         <div class="form-group">
                           <label for="new_pass">New Password</label>
                           <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="Password">
                        </div> 

                        <div class="form-group">
                           <label for="conf_pass">Confirm Password</label>
                           <input type="password" name="conf_pass" class="form-control" id="conf_pass" placeholder="Password">
                        </div> 

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end">Update Password</button>
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