@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">SubAdmins Pages</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">SubAdmins Pages</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">SubAdmins Pages</h3>
                <a href="{{url('admin/create-subadmins')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add New Page  </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{Session::get('success_message')}}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                @elseif(Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          {{Session::get('error_message')}}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                @endif

               <table id="subadmins" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Created On</th>
                    <th>Status</th>                   
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     @php $i=1; @endphp
                     @foreach($subadmins as $subadmin)
                     <tr>
                        <td>{{$i++}}</td>
                        <td>{{ucfirst($subadmin['name'])}}</td>
                        <td>{{$subadmin['mobile']}}</td>
                        <td>{{$subadmin['email']}}</td>
                        <td>{{$subadmin['type']}}</td>
                        <td>{{date('F j, Y, g:i a',strtotime($subadmin['created_at']))}}</td>
                         <td>
                           @if($subadmin['status'] == 1)
                             <a class="updateSubdomainsStatus" id="page-{{$subadmin['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                           @else
                              <a class="updateSubdomainsStatus" id="page-{{$subadmin['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                           @endif   
                        </td>                      

                        <td width="12%">                          

                           <a title="Edit" class="update btn btn-sm btn-warning" href="{{'/admin/edit-subadmins/'.$subadmin['id']}}"> <i class="fa fa-wrench"></i></a>                            

                           <a title="Delete" class="delete btn btn-sm btn-danger confirmDeleteSubdomains" href="javascript:void(0)" recordid="{{ $subadmin['id'] }}"><i class="fa fa-trash" aria-hidden="true"></i></a>

                             <a title="Role and Permissions" class="view btn btn-sm btn-info" href="{{'/admin/update-role/'.$subadmin['id']}}"> <i class="fa fa-lock"></i></a>

                        </td>
                     </tr>
                     @endforeach
              
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection
