 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url("/")}}" class="brand-link text-center">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        {{-- <div class="info text-center">
          <a href="#" class="d-block text-center">{{auth()->user()->name}}</a>
        </div> --}}
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{url("/")}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard                
              </p>
            </a>
            
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Newsfeed
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('newsfeed.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Newsfeeds</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('newsfeed.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All News Feeds</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Testimonials
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('testimonial.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Testimonial</p>
                </a>
              </li>

            </ul>
          </li> --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>

             

            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('testimonial.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Testimonials</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('contact.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Contact Forms</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('seo-panel')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Seo Panel</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="https://www.sociablekit.com/app/users/widgets/update_embed/251635" target="_blank" class="nav-link" style="color: skyblue">
              
              <p>Social Media Feed Request Sync</p>
              <i class="fa fa-arrow-right nav-icon"></i>
            </a>
          </li>

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>