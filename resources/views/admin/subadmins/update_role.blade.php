@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Updat Subadmis Roles</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Updat Subadmis Roles</li>
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
                     <h3 class="card-title">Updat Subadmis Roles</h3>
                     <a href="{{url('admin/subadmins')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List subadmins</a>
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

                  <form action="{{url('admin/update-role/'.$id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subadmin_id" value="{{$id}}">
                    @if(!empty($subadminsRoles))
                     @foreach($subadminsRoles as $role)
                      @if($role['module']=='information_pages')                        
                        @if($role['view_access']==1)
                           @php $viewInformationPages="checked" @endphp
                        @else
                           @php $viewInformationPages="" @endphp
                        @endif

                        @if($role['edit_access']==1)
                           @php $editInformationPages="checked" @endphp
                        @else
                           @php $editInformationPages="" @endphp
                        @endif

                        @if($role['full_access']==1)
                           @php $fullInformationPages="checked" @endphp
                        @else
                           @php $fullInformationPages="" @endphp
                        @endif
                      @endif

                      @if($role['module']=='category_page')                        
                        @if($role['view_access']==1)
                           @php $viewCategoryPages="checked" @endphp
                        @else
                           @php $viewCategoryPages="" @endphp
                        @endif

                        @if($role['edit_access']==1)
                           @php $editCategoryPages="checked" @endphp
                        @else
                           @php $editCategoryPages="" @endphp
                        @endif

                        @if($role['full_access']==1)
                           @php $fullCategoryPages="checked" @endphp
                        @else
                           @php $fullCategoryPages="" @endphp
                        @endif
                      @endif

                       @if($role['module']=='product_page')                        
                        @if($role['view_access']==1)
                           @php $viewProductPages="checked" @endphp
                        @else
                           @php $viewProductPages="" @endphp
                        @endif

                        @if($role['edit_access']==1)
                           @php $editProductPages="checked" @endphp
                        @else
                           @php $editProductPages="" @endphp
                        @endif

                        @if($role['full_access']==1)
                           @php $fullProductPages="checked" @endphp
                        @else
                           @php $fullProductPages="" @endphp
                        @endif
                      @endif

                      @if($role['module']=='brand_page')                        
                        @if($role['view_access']==1)
                           @php $viewBrandPages="checked" @endphp
                        @else
                           @php $viewBrandPages="" @endphp
                        @endif

                        @if($role['edit_access']==1)
                           @php $editBrandPages="checked" @endphp
                        @else
                           @php $editBrandPages="" @endphp
                        @endif

                        @if($role['full_access']==1)
                           @php $fullBrandPages="checked" @endphp
                        @else
                           @php $fullBrandPages="" @endphp
                        @endif
                      @endif

                       @if($role['module']=='banner_page')                        
                        @if($role['view_access']==1)
                           @php $viewBannerPages="checked" @endphp
                        @else
                           @php $viewBannerPages="" @endphp
                        @endif

                        @if($role['edit_access']==1)
                           @php $editBannerPages="checked" @endphp
                        @else
                           @php $editBannerPages="" @endphp
                        @endif

                        @if($role['full_access']==1)
                           @php $fullBannerPages="checked" @endphp
                        @else
                           @php $fullBannerPages="" @endphp
                        @endif
                      @endif

                       @if($role['module']=='datalist_page')                        
                        @if($role['view_access']==1)
                           @php $viewDataListPages="checked" @endphp
                        @else
                           @php $viewDataListPages="" @endphp
                        @endif

                        @if($role['edit_access']==1)
                           @php $editDataListPages="checked" @endphp
                        @else
                           @php $editDataListPages="" @endphp
                        @endif

                        @if($role['full_access']==1)
                           @php $fullDataListPages="checked" @endphp
                        @else
                           @php $fullDataListPages="" @endphp
                        @endif
                      @endif


                     @endforeach
                    @endif
                     <div class="card-body">
                        <div class="row">                       
                        <div class="form-group col-md-12">                        
                           <label for="information_pages">Information Pages : &nbsp;</label>                            
                           <input type="checkbox" name="information_pages[view]" value="1" @if(isset($viewInformationPages)) {{$viewInformationPages}} @endif> &nbsp;View Access 
                           <input type="checkbox" name="information_pages[edit]" value="1" @if(isset($editInformationPages)) {{$editInformationPages}} @endif> &nbsp;View/Edit Access
                           <input type="checkbox" name="information_pages[full]" value="1" @if(isset($fullInformationPages)) {{$fullInformationPages}} @endif> &nbsp;
                            Full Access          
                        </div>     

                        <div class="form-group col-md-12">                        
                           <label for="category_page">Category Page : &nbsp;</label>                            
                           <input type="checkbox" name="category_page[view]" value="1" @if(isset($viewCategoryPages)) {{$viewCategoryPages}} @endif> &nbsp;View Access 
                           <input type="checkbox" name="category_page[edit]" value="1" @if(isset($editCategoryPages)) {{$editCategoryPages}} @endif> &nbsp;View/Edit Access
                           <input type="checkbox" name="category_page[full]" value="1" @if(isset($fullCategoryPages)) {{$fullCategoryPages}} @endif> &nbsp;
                            Full Access          
                        </div>  

                        <div class="form-group col-md-12">                        
                           <label for="product_page">Product Page : &nbsp;</label>                            
                           <input type="checkbox" name="product_page[view]" value="1" @if(isset($viewProductPages)) {{$viewProductPages}} @endif> &nbsp;View Access 
                           <input type="checkbox" name="product_page[edit]" value="1" @if(isset($editProductPages)) {{$editProductPages}} @endif> &nbsp;View/Edit Access
                           <input type="checkbox" name="product_page[full]" value="1" @if(isset($fullProductPages)) {{$fullProductPages}} @endif> &nbsp;
                            Full Access          
                        </div>   

                        <div class="form-group col-md-12">                        
                           <label for="brand_page">Brand Page : &nbsp;</label>                            
                           <input type="checkbox" name="brand_page[view]" value="1" @if(isset($viewBrandPages)) {{$viewBrandPages}} @endif> &nbsp;View Access 
                           <input type="checkbox" name="brand_page[edit]" value="1" @if(isset($editBrandPages)) {{$editBrandPages}} @endif> &nbsp;View/Edit Access
                           <input type="checkbox" name="brand_page[full]" value="1" @if(isset($fullBrandPages)) {{$fullBrandPages}} @endif> &nbsp;
                            Full Access          
                        </div> 

                        <div class="form-group col-md-12">                        
                           <label for="banner_page">Banner Page : &nbsp;</label>                            
                           <input type="checkbox" name="banner_page[view]" value="1" @if(isset($viewBannerPages)) {{$viewBannerPages}} @endif> &nbsp;View Access 
                           <input type="checkbox" name="banner_page[edit]" value="1" @if(isset($editBannerPages)) {{$editBannerPages}} @endif> &nbsp;View/Edit Access
                           <input type="checkbox" name="banner_page[full]" value="1" @if(isset($fullBannerPages)) {{$fullBannerPages}} @endif> &nbsp;
                            Full Access          
                        </div>     

                         <div class="form-group col-md-12">                        
                           <label for="datalist_page">DataList Page : &nbsp;</label>                            
                           <input type="checkbox" name="datalist_page[view]" value="1" @if(isset($viewDataListPages)) {{$viewDataListPages}} @endif> &nbsp;View Access 
                           <input type="checkbox" name="datalist_page[edit]" value="1" @if(isset($editDataListPages)) {{$editDataListPages}} @endif> &nbsp;View/Edit Access
                           <input type="checkbox" name="datalist_page[full]" value="1" @if(isset($fullDataListPages)) {{$fullDataListPages}} @endif> &nbsp;
                            Full Access          
                        </div>        

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Update Subadmins</button>
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