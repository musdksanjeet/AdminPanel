@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Add DataList</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Add DataList</li>
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
                     <h3 class="card-title">Add DataList</h3>
                     <a href="{{url('admin/data-list')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> List DataList</a>
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

                  <form action="{{url('admin/store-data-list')}}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="card-body">
                        <div class="row">
                        
                        <div class="col-lg-6">
                        <div class="form-group">
                           <label>&nbsp;</label>                           
                           <select name="datalist_type" id="datalist_type" class="form-control">
                              <option value="1">--New Field--</option>   
                              @foreach($dataListFields as $field)
                                 <option value="{{$field['newid']}}">{{$field['field_name']}}</option>
                              @endforeach                           
                           </select>
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="field_name">Field Name</label>                           
                           <input type="text" name="field_name" id="field_name" class="form-control">
                        </div>      
                        </div>


                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="list_id">List Id</label>                           
                           <input type="text" name="list_id" id="list_id" class="form-control" readonly>
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="value">Value</label>                           
                           <input type="text" name="value" id="value" class="form-control">
                        </div>      
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                           <label for="banner_status">DataList Status</label>
                           <select name="datalist_status" class="form-control" id="datalist_status">
                               <option value="">=== Select Status ===</option>
                               <option value="1">Active</option>
                               <option value="0">InActive</option>
                           </select>
                        </div>                              
                        </div>   


                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary text-end float-right">Add DataList</button>
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
  $(document).ready(function(){
   $('#list_id').val( $('#datalist_type').val() );
   $(document).on('change','#datalist_type',function()
   {
      $('#field_name').val('');
      $('#field_name').attr('readonly', false);
      $('#list_id').val(this.value);
      
      if(this.value > 1){
         $('#field_name').val( $(this).find("option:selected").text() );
         $('#field_name').attr('readonly', true);
      }
   });
});
</script>