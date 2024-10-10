@extends('admin.layouts.layout')

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Add Setting</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add Setting</li>
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
                     <h3 class="card-title">Add Setting</h3>
                     <a href="{{url('admin/general')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List Setting</a>
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

                  <!-- Form -->
                 
                     <input type="hidden" name="tab" id="activeTab" value="general">
                     
                     <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="settingTab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="general-info-tab" data-toggle="tab" href="#general-info" role="tab" aria-controls="general-info" aria-selected="true">1. General</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="local-info-tab" data-toggle="tab" href="#local-info" role="tab" aria-controls="local-info" aria-selected="false">2. Local </a>
                           </li>                          
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade show active" id="general-info" role="tabpanel" aria-labelledby="general-info-tab">
                             <form id="settingsForm" action="{{url('admin/store-general')}}" method="post" enctype="multipart/form-data">
                              @csrf
                             <div class="row">
                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_name">Website Name</label>
                                 <input type="text" class="form-control" name="website_name" id="website_name" placeholder="Website Name">
                              </div>
                              </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_url">Website URL</label>
                                 <input type="text" class="form-control" name="website_url" id="website_url" placeholder="Website URL">
                              </div>
                            </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_email">Website Email</label>
                                 <input type="email" class="form-control" name="website_email" id="website_email" placeholder="Website Email">
                              </div>
                              </div>
                                
                              <div class="col-lg-6">
                               <div class="form-group mt-3">
                                 <label for="website_phone">Website Phone</label>
                                 <input type="text" class="form-control" name="website_phone" id="website_phone" placeholder="Website Phone">
                              </div>
                              </div>                              

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_address">Website Address</label>
                                 <input type="text" class="form-control" name="website_address" id="website_address" placeholder="Website Address">
                              </div> 
                              </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="status">Category Status</label>
                                 <select name="status" class="form-control" id="status">
                                     <option value="">=== Select Status ===</option>
                                     <option value="1">Active</option>
                                     <option value="0">InActive</option>
                                 </select>
                              </div>                              
                              </div> 

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="favicon">Favicon Icon</label>
                                 <input type="file" class="form-control" name="favicon" id="favicon">
                              </div> 
                              </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_logo">Website Logo</label>
                                 <input type="file" class="form-control" name="website_logo" id="website_logo">
                              </div> 
                              </div>

                           </div> 
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary text-end float-right">Add General Setting</button>
                           </div>
                          </form>
                           </div>

                           <!-- Local Info Tab -->
                           <div class="tab-pane fade" id="local-info" role="tabpanel" aria-labelledby="local-info-tab">
                            <form id="settingsForm" action="{{url('admin/store-local')}}" method="post" enctype="multipart/form-data">
                              @csrf
                            <div class="row">
                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="timezone">TimeZone</label>
                                 <input type="text" class="form-control" name="timezone" id="timezone" placeholder="Website TimeZone">
                              </div>
                              </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="currency">Website Currency</label>
                                 <input type="text" class="form-control" name="currency" id="currency" placeholder="Website Currency">
                              </div>
                            </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_vat">Website VAT</label>
                                 <input type="text" class="form-control" name="website_vat" id="website_vat" placeholder="Website VAT">
                              </div>
                              </div>
                                
                              <div class="col-lg-6">
                               <div class="form-group mt-3">
                                 <label for="miles">Miles</label>
                                 <input type="text" class="form-control" name="miles" id="miles" placeholder="Website Miles">
                              </div>
                              </div>                              

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="website_prefix">Website Prefix</label>
                                 <input type="text" class="form-control" name="website_prefix" id="website_prefix" placeholder="Website Prefix">
                              </div> 
                              </div>

                              <div class="col-lg-6">
                              <div class="form-group mt-3">
                                 <label for="language">Default Language</label>
                                 <input type="text" class="form-control" name="language" id="language" placeholder="Language">
                              </div>                              
                              </div>                          

                           </div> 
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary text-end float-right">Add Local Setting</button>
                           </div>
                          </form>
                          </div> 
                          
                        </div>
                     </div>
                     <!-- /.card-body -->
                     
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>

@push('scripts')
<script>
   $(function () {
      $('#settingTab a').on('click', function (e) {
         e.preventDefault();
         $(this).tab('show');
         $('#activeTab').val($(this).attr('href').replace('#', ''));
      });

      // Initialize the hidden input with the current active tab
      $('#activeTab').val($('.nav-tabs .nav-link.active').attr('href').replace('#', ''));
   });
</script>
@endpush

@endsection
