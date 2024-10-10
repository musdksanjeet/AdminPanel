@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Crud Generation</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Crud Generation</li>
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
               <div class="card card-secondary">
                  <div class="card-header">
                     <h3 class="card-title"><i class="fa fa-plus"></i> Generate CRUD</h3>
                     <a href="javascript:void(0)" class="btn btn-primary float-right"><i class="fa fa-list"></i> Extension List</a>
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

                  <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="module_name">Module Name</label>
                           <input type="text" class="form-control" name="module_name" id="module_name" placeholder="Module Name">                         
                        </div>                              
                        </div>  
                       
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="table_name">DB Table</label>
                           <input type="text" class="form-control" name="table_name" id="table_name" placeholder="Table Name">
                        </div>      
                        </div> 

                        <div class="col-lg-12">
                        <div class="input_field_wrap">
                           <button class="add_field_button btn btn-success float-right">Add More Fields</button>
                        </div> 
                        </div>

                        <div class="col-lg-12">
                           
                        </div>

                     </div>
                  </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Generate CRUD</button>
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
