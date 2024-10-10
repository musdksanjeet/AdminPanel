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
                     <h3 class="card-title">View Setting</h3>
                     <a href="{{url('admin/general')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Setting</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          
                       <tr>
                          <th>Company Name</th>
                          <td>{{$viewRecord->application_name}}</td>
                          <th>Company URL</th>
                          <td>{{$viewRecord->application_url}}</td>                           
                       </tr> 

                        <tr>
                          <th>Company Email</th>
                          <td>{{$viewRecord->website_email}}</td>
                          <th>Company Phone</th>
                          <td>{{$viewRecord->website_phone}}</td>                           
                       </tr>

                       <tr>
                          <th>Timezone</th>
                          <td>{{$viewRecord->timezone}}</td>
                          <th>Currancy</th>
                          <td>{{$viewRecord->currency}}</td>                           
                       </tr>
                       <tr>
                          <th>Company VAT</th>
                          <td>{{$viewRecord->vat}}</td>
                          <th>Miles</th>
                          <td>{{$viewRecord->miles}}</td>                           
                       </tr>

                        <tr>
                          <th>Prefix</th>
                          <td>{{$viewRecord->prefix}}</td>
                          <th>Language</th>
                          <td>{{$viewRecord->default_language}}</td>                           
                       </tr>

                       <tr>
                          <th>Company Address</th>
                          <td>{{$viewRecord->website_address}}</td>
                          <th>Category Satus</th>
                          <td>
                            @if($viewRecord->status == 1)
                                 <a class="updateSettingStatus" id="page-{{$viewRecord->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                            @else
                                 <a class="updateSettingStatus" id="page-{{$viewRecord->id}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                            @endif
                          </td>                           
                       </tr>  


                       <tr>
                           <th>Favicon Icon</th>
                           <td>
                              <img src="{{url('front/images/logo/'.$viewRecord->favicon)}}"/ width="50px" height="50px">
                           </td>
                           <th>Logo</th>
                           <td>
                              <img src="{{url('front/images/logo/'.$viewRecord->logo)}}"/ width="50px" height="50px">
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
