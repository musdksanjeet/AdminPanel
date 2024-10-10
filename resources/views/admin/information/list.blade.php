@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">List Pages</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">List Pages</li>
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
                <h3 class="card-title">List All Information Pages</h3>
                @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)               
                  <a href="{{url('admin/create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add New Page  </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table id="listpages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Meta Keyword</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     @php $i=1; @endphp
                     @foreach($pages as $page)
                     <tr>
                        <td>{{$i++}}</td>
                        <td>{{$page['title']}}</td>
                        <td>{{$page['url']}}</td>
                        <td>{{$page['meta_title']}}</td>
                        <td>{{$page['meta_description']}}</td>
                        <td>{{$page['meta_keyword']}}</td>
                        <td>
                           @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                           @if($page['status'] == 1)
                             <a class="updateCmsPageStatus" id="page-{{$page['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-on" status="active" style="font-size:37px;color:green;"></i></a>
                           @else
                              <a class="updateCmsPageStatus" id="page-{{$page['id']}}" href="javascript:void(0)"> <i class="fas fa-toggle-off" status="inactive" style="font-size:37px;color:white;"></i></a>
                           @endif   
                           @endif
                        </td>

                        <td width="12%">
                           @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                            <a title="View" class="view btn btn-sm btn-info" href="{{'/admin/view/'.$page['id']}}"> <i class="fa fa-eye"></i></a>

                           <a title="Edit" class="update btn btn-sm btn-warning" href="{{'/admin/edit/'.$page['id']}}"> <i class="fa fa-wrench"></i></a>

                           <!-- <a title="Delete" class="delete btn btn-sm btn-danger confirmDelete" name="information page" title="Delete Information Page"href="{{'/admin/delete/'.$page['id']   }}"> <i class="fa fa-trash" aria-hidden="true"></i></a> -->
                           @endif
                            @if($pagesModule['full_access']==1)
                              <a title="Delete" class="delete btn btn-sm btn-danger confirmDelete" href="javascript:void(0)" recordid="{{ $page['id'] }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                           @endif
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
