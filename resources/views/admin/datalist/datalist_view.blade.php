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
                     <h3 class="card-title">View DataList</h3>
                     <a href="{{url('admin/data-list')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List DataList</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          
                       <tr>
                          <th>Field Name</th>
                          <td> {{$datalistRecords->field_name}}</td>
                          <th>List Id</th>
                          <td>{{$datalistRecords->list_id}}</td>
                           
                       </tr>  
                       <tr>
                           <th>Value</th>
                           <td>{{$datalistRecords->value}}</td>
                           <th>Status</th>
                           <td>
                            @if($datalistRecords->status == 1)
                                 <a class="updateDataListStatus" id="page-{{$datalistRecords->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                 <a class="updateDataListStatus" id="page-{{$datalistRecords->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
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
