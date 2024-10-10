@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Add Brand</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add Brand</li>
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
                     <h3 class="card-title">Add Brand</h3>
                     <a href="{{url('admin/brands')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Category</a>
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

                  <form action="{{url('admin/update-brand/'.$id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="brand_name">Brand Name</label>
                           <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Brand Name" value="{{$bradndRecord->brand_name}}">                         
                        </div>                              
                        </div>  
                       
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="brand_url">Brand Url</label>
                           <input type="text" class="form-control" name="brand_url" id="brand_url" placeholder="Brand Url" value="{{$bradndRecord->brand_slug}}">
                        </div>      
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="brand_url">Brand Image</label>
                           <!-- <input type="text" class="form-control" name="brand_url" id="brand_url" placeholder="Brand Url"> -->
                           <input type="file" name="image" class="form-control">
                        </div>      
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="brand_status">Category Status</label>
                           <select name="brand_status" class="form-control" id="brand_status">
                               <option value="">=== Select Status ===</option>
                               <option value="1" {{$bradndRecord->status ==1 ? 'selected':''}}>Active</option>
                               <option value="0" {{$bradndRecord->status ==0 ? 'selected':''}}>InActive</option>
                           </select>
                        </div>                              
                        </div> 
                               

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Brand</button>
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
        $('#brand_name').on('keyup', function() {
            var brand_name = $(this).val();           
            var brand_url = brand_name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
            $('#brand_url').val(brand_url);
        });
    });
</script>
