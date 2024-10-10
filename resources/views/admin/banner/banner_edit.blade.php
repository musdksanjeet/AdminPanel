@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Add Banner</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add Banner</li>
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
                     <h3 class="card-title">Add Banner</h3>
                     <a href="{{url('admin/banners')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Banner</a>
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

                  <form action="{{url('admin/update-banner/'.$bannerList->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        
                         <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_type">Banner Type</label>
                           <select name="banner_type" id="banner_type" class="form-control">
                              <option value="">=== Select Type ===</option>
                              <option value="banner" {{$bannerList->type =='banner' ? 'selected':''}}>Banner</option>
                              <option value="thumnail" {{$bannerList->type =='thumnail' ? 'selected':''}}>Thumbnail</option>
                              <option value="gallery" {{$bannerList->type =='gallery' ? 'selected':''}}>Gallery</option>
                           </select>
                        </div>      
                        </div>                         
                       
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_link">Banner Link</label>
                           <input type="text" class="form-control" name="banner_link" id="banner_link" placeholder="Banner Link" value="{{$bannerList->link}}">
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_title">Banner Title</label>
                           <input type="text" class="form-control" name="banner_title" id="banner_title" placeholder="Banner Title" value="{{$bannerList->title}}">
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_alt">Banner Alt</label>
                           <input type="text" class="form-control" name="banner_alt" id="banner_alt" placeholder="Banner Alt" value="{{$bannerList->alt}}">
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_order">Banner Order</label>
                           <input type="number" class="form-control" name="banner_order" id="banner_order" placeholder="Banner Order" value="{{$bannerList->sort}}">
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_image">Banner Image</label>
                           <input type="file" class="form-control" name="banner_image" id="banner_image" placeholder="Brand Image">   
                           @if($bannerList->image)                          
                              <a href="{{url('front/images/banner/'.$bannerList->image)}}" target="_blank">
                                 View Image
                              </a>                 
                           @endif                      
                        </div>                              
                        </div>                       

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_status">Banner Status</label>
                           <select name="banner_status" class="form-control" id="banner_status">
                               <option value="">=== Select Status ===</option>
                               <option value="1" {{$bannerList->status ==1 ? 'selected':''}}>Active</option>
                               <option value="0" {{$bannerList->status ==0 ? 'selected':''}}>InActive</option>
                           </select>
                        </div>                              
                        </div> 
                               

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Banner</button>
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
