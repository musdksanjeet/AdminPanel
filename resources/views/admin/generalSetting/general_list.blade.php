@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Setting List</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Setting List</li>
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
                <h3 class="card-title">Setting</h3>                             
                  <a href="{{url('admin/create-general')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add Setting  </a>             
               </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table id="generalList" class="table table-bordered table-hover">
                 <thead>

                  <tr>
                    <th>Id</th>
                    <th>Website Name</th>
                    <th>Website URL</th>                    
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     @php $i=1; @endphp
                     @foreach($generalRecord as $general)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$general->application_name}}</td>
                      <td>{{$general->application_url}}</td>
                      <td>
                        @if($general->status==1)
                          <a class="updateSettingStatus" id="page-{{$general->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>  
                        @else
                          <a class="updateSettingStatus" id="page-{{$general->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>      
                        @endif
                      </td>
                      <td>
                          <a title="View" class="view btn btn-sm btn-info" href="{{url('admin/general-view/'.$general->id)}}"> <i class="fa fa-eye"></i></a>

                          <a title="Edit" class="update btn btn-sm btn-warning" href="{{url('admin/general-edit/'.$general->id)}}"> <i class="fa fa-wrench"></i></a>

                          <a title="Delete" class="delete btn btn-sm btn-danger confirmGeneralDelete" href="javascript:void(0)" recordid="{{$general->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
