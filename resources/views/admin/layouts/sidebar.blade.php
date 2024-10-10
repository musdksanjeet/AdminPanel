 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
      <img src="{{asset('admin/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Recenturesoft</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(Auth::guard('admin')->user()->image))
          <img src="{{asset('admin/images/photos'.'/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{asset('admin/img/user1-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block">{{ ucfirst(Auth::guard('admin')->user()->name) }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">    
          @if(Session::get('page')=="dashboard")
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item menu-open">
            <a href="{{url('admin/dashboard')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>


          <!-- Profile Data -->
           @if(Auth::guard('admin')->user()->type == 'admin')
          @if(Session::get('page')=="update-profile" ||Session::get('page')=="update-password")
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-user"></i><p>Profile</p>
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              @if(Session::get('page')=="update-profile")
                @php $active="active" @endphp
              @else
                @php $active="" @endphp
              @endif
              <li class="nav-item">
                <a href="{{url('admin/update-profile')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Profile</p>
                </a>
              </li>
                @if(Session::get('page')=="update-password")
                  @php $active="active" @endphp
                @else
                  @php $active="" @endphp
                @endif
              <li class="nav-item">
                <a href="{{url('admin/update-password')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li> 

            </ul>
          </li> 
          @endif

          <!-- Product and Category Relateds  -->
          @if(Session::get('page')=="Category" || Session::get('page')=="Product" )
                @php $active="active" @endphp
           @else
                @php $active="" @endphp
           @endif
          <li class="nav-item">
            <a href="#" class="nav-link {{$active}}">
              <i class="fa fa-tags fw"></i>
              <p>
                Catalog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               @if(Session::get('page')=="Category")
                @php $active="active" @endphp
               @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/category')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>

              @if(Session::get('page')=="Product")
                @php $active="active" @endphp
               @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/products')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>

              @if(Session::get('page')=="Brand")
                @php $active="active" @endphp
               @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/brands')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
                
            </ul>
          </li>

          
          <!-- CMS Pages  -->
           @if(Session::get('page')=="information" ||Session::get('page')=="Banner")
                @php $active="active" @endphp
           @else
                @php $active="" @endphp
           @endif
          <li class="nav-item">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                CMS Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               @if(Session::get('page')=="information")
                @php $active="active" @endphp
               @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/information')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Information Pages</p>
                </a>
              </li>

              @if(Session::get('page')=="Banner")
                @php $active="active" @endphp
               @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/banners')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
                
            </ul>
          </li>

          <!-- Data List Table -->
          @if(Session::get('page')=="data-list")
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item">
            <a href="{{url('admin/data-list')}}" class="nav-link {{$active}}">
              <i class="nav-icon fa fa-bars"></i>
              <p>Data List</p>
            </a>
          </li>

          <!-- Roles and Permission -->
          @if(Auth::guard('admin')->user()->type == 'admin')
          @if(Session::get('page')=="subadmin"||Session::get('page')=="general_setting")
                @php $active="active" @endphp
           @else
                @php $active="" @endphp
           @endif
          <li class="nav-item">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Session::get('page')=="general_setting")
                @php $active="active" @endphp
              @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/general')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Settings</p>
                </a>
              </li> 

               @if(Session::get('page')=="subadmin")
                @php $active="active" @endphp
               @else
                    @php $active="" @endphp
               @endif
              <li class="nav-item">
                <a href="{{url('admin/subadmins')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subadmins Settings</p>
                </a>
              </li> 

            </ul>
          </li>

          <!-- Backup and Export Data -->         
          @if(Session::get('page')=="backup")
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item">
            <a href="{{url('admin/export')}}" class="nav-link {{$active}}">
              <i class="nav-icon fa fa-database"></i>
              <p>Backup & Export</p>
            </a>
          </li>

          <!-- Generate Crud -->                
          @if(Session::get('page')=="crud")
            @php $active="active" @endphp
          @else
            @php $active="" @endphp
          @endif
          <li class="nav-item">
            <a href="{{url('admin/crud')}}" class="nav-link {{$active}}">
             <i class="nav-icon fas fa-chart-pie"></i>
              <p>Crud Generation</p>
            </a>
          </li>


          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>