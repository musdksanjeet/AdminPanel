@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Edit Category</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Edit Category</li>
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
                     <h3 class="card-title">Edit Category</h3>
                     <a href="{{url('admin/category')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Category</a>
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

                  <form action="{{ url('admin/update-category/' . $id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        
                        
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_name">Category Name</label>
                           <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name" value="{{$categoryRecord->category_name}}">                         
                        </div>                              
                        </div>  
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="parent_id">Parent Id</label>
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="">===Select Parent===</option>
                                    <option value="0" {{ $categoryRecord->parent_id == 0 ? 'selected' : '' }}>Main Category</option>
                                    @foreach($gatCategories as $cat)
                                        <option value="{{ $cat->id }}" {{ $categoryRecord->parent_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                        @foreach($cat->nestedSubCategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $categoryRecord->parent_id == $subcategory->id ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;--- {{ $subcategory->category_name }}
                                            </option>
                                            @foreach($subcategory->nestedSubCategories as $subsubcategory)
                                                <option value="{{ $subsubcategory->id }}" {{ $categoryRecord->parent_id == $subsubcategory->id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--- {{ $subsubcategory->category_name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_url">Category Url</label>
                           <input type="text" class="form-control" name="category_url" id="category_url" placeholder="Category Url" value="{{$categoryRecord->category_url}}">
                        </div>      
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_discount">Category Discount</label>
                           <input type="text" name="category_discount" class="form-control" id="category_discount" placeholder="Category Discount" value="{{$categoryRecord->category_discount}}">
                        </div>                              
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                           <label for="category_discription">Category Discription</label>
                           <textarea id= "summernote" name="category_discription" class="form-control">{{$categoryRecord->category_description}}</textarea>
                        </div>                              
                        </div>                       

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_meta_title">Category Meta Title</label>
                           <input type="text" name="category_meta_title" class="form-control" id="category_meta_title" placeholder="Category Meta Title" value="{{$categoryRecord->category_meta_title}}">
                        </div>                              
                        </div>                        

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_meta_description">Category Meta Description</label>
                           <input type="text" name="category_meta_description" class="form-control" id="category_meta_description" placeholder="Category Meta Description" value="{{$categoryRecord->category_meta_description}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_meta_keyword">Category Meta Keyword</label>
                           <input type="text" name="category_meta_keyword" class="form-control" id="category_meta_keyword" placeholder="Category Meta Keyword" value="{{$categoryRecord->category_meta_keyword}}">
                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_image">Category Image</label>
                           <input type="file" name="category_image" class="form-control" id="category_image" placeholder="Category Image">

                        </div>                              
                        </div> 

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="category_status">Category Stats</label>
                           <select name="category_status" class="form-control" id="category_status">
                                 <option>=== Select Status ===</option>
                                 <option value="1" {{ $categoryRecord->category_status == 1 ? 'selected' : '' }}>Active</option>
                                 <option value="0" {{ $categoryRecord->category_status == 0 ? 'selected' : '' }}>InActive</option>
                           </select>
                        </div>                              
                        </div> 
                               

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Category</button>
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
        $('#category_name').on('keyup', function() {
            var category_name = $(this).val();           
            var category_url = category_name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
            $('#category_url').val(category_url);
        });
    });
</script>
