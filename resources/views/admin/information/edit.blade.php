@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Edit Pages</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Edit Pages</li>
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
                     <h3 class="card-title">Edit Page</h3>
                     <a href="{{url('admin/information')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Page</a>
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

                  <form action="{{ url('admin/update/' . $infoedit->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6">
                         <div class="form-group">
                                 <label for="title">Title</label>
                                 <input type="text" class="form-control" name="title" id="title" placeholder="title" wire:keyup="generateSlug" value="{{$infoedit->title}}">
                              </div>
                         </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="url">Url</label>
                           <input type="text" name="url" class="form-control" id="url" placeholder="URL"placeholder="Enter URL" value="{{$infoedit->url}}">
                        </div>                              
                        </div>

                        <div class="col-lg-12">
                        <div class="form-group">
                           <label for="description">Description</label>
                           <textarea name="description" id="summernote" class="form-control" rows="3" placeholder="Enter Description">{{$infoedit->description}}</textarea>
                        </div>      
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_title">Meta Title</label>
                           <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="URL"placeholder="Enter Meta Title" value="{{$infoedit->meta_title}}">
                        </div>                              
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_desc">Meta Description</label>
                           <input type="text" name="meta_desc" class="form-control" id="meta_desc" placeholder="URL"placeholder="Enter Meta description" value="{{$infoedit->meta_description}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="meta_keyword">Meta Keyword</label>
                           <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="URL"placeholder="Enter Meta Keyword" value="{{$infoedit->meta_keyword}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="status">Status</label>
                          <select class="form-control" name="status" id="status" value="{{$infoedit->status}}">
                             <option>===Select Status===</option>
                             <option value="1" {{ $infoedit->status == 1 ? 'selected' : '' }}>Active</option>
                             <option value="0" {{ $infoedit->status == 0 ? 'selected' : '' }}>Inactive</option>                          
                        </select>
                        </div>                              
                        </div>                

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Page</button>
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
<script type="text/javascript">
   $(document).ready(function() {
        $('#title').on('keyup', function() {
            var title = $(this).val();
            var url = title.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
            $('#url').val(url);
        });
    });
</script>
