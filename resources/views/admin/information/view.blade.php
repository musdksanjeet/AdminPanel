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
                     <h3 class="card-title">View Page</h3>
                     <a href="{{url('admin/information')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Page</a>
                  </div>
                 <table class="table table-bordered">
                    <tbody>
                       <tr>
                          <th>Title</th>
                          <td>{{$page->title}}</td>
                           <th>URL</th>
                          <td>{{$page->url}}</td>
                       </tr>
                        <tr>
                          <th>Meta Title</th>
                          <td>{{$page->meta_title}}</td>
                           <th>Meta Description</th>
                          <td>{{$page->meta_description}}</td>
                       </tr>
                       <tr>
                          <th>Meta Keyword</th>
                          <td>{{$page->meta_keyword}}</td>
                           <th>Satus</th>
                          <td>
                            @if($page['status'] == 1)
                             <a class="updateCmsPageStatus" id="page-{{$page['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                           @else
                              <a class="updateCmsPageStatus" id="page-{{$page['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                           @endif
                          </td>
                       </tr>
                       <tr>
                          <th>Description</th>
                          <td colspan="3">{{strip_tags($page->description)}}</td>
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
