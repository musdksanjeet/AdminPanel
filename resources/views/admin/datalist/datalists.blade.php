@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">DataLists Table</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">DataLists Table</li>
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
                <h3 class="card-title">DataLists</h3>   
                   @if($dataListModule['edit_access']==1 || $dataListModule['full_access']==1)
                  <a href="{{url('admin/create-data-list')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add New DataList</a>
                  @endif
          
               </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table id="brandList" class="table table-bordered table-hover">
                 <thead>

                  <tr>
                    <th>Id</th>
                    <th>Field Name</th>                 
                    <th>List id</th>
                    <th>Value</th>                    
                    <th>Status</th>                   
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                   @php  $i=1; @endphp
                   @foreach ($datalistRecords as $list)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$list->field_name}}</td>
                      <td>{{$list->list_id}}</td>
                      <td>{{$list->value}}</td>
                      <td> 
                        @if($dataListModule['edit_access']==1 || $dataListModule['full_access']==1)
                        @if($list->status == 1)
                             <a class="updateDataListStatus" id="page-{{$list->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>  
                        @else                    
                              <a class="updateDataListStatus" id="page-{{$list->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>                    
                       @endif
                       @endif
                     </td>
                     <td>
                       @if($dataListModule['edit_access']==1 || $dataListModule['full_access']==1)
                         <a title="View" class="view btn btn-sm btn-info" href="{{url('admin/data-list-view/'.$list->id)}}"> <i class="fa fa-eye"></i></a>

                         <a title="Edit" class="update btn btn-sm btn-warning" href="{{url('admin/data-list-edit/'.$list->id)}}"> <i class="fa fa-wrench"></i></a>
                         @endif
                         @if($dataListModule['full_access']==1)
                         <a title="Delete" class="delete btn btn-sm btn-danger confirmDataListDelete" href="javascript:void(0)" recordid="{{$list->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
