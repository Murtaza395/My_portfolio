<header class="header">   
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
          <div class="close-btn">Close <i class="fa fa-close"></i></div>
        </div>
      </div>
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <a href="{{route('admin.dashboard')}}" class="navbar-brand">
            <div class="brand-text brand-big visible text-uppercase"><strong>Admin</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary"></strong><strong>A</strong></div></a>
          <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
        </div>
        @if (Session::has('success'))
          
        
        <div class="container">
        <p class="alert alert-success alert-dismissible fade show"> {{Session::get('success')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </p>
        </div>
        @endif
        @if (Session::has('error'))
          
        
        <div class="container">
        <p class="alert alert-success alert-dismissible fade show"> {{Session::get('error')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </p>
        </div>
        @endif
      </div>
         <div class="d-flex justify-content-between">
          <div class="list-inline-item logout">      
            <a href="{{route('admin.logout')}}" class="btn btn-primary text-white">Logout</a>
        </div>
        @if (Auth::guard('admin')->check())  
        <div>
            <a href="{{route('admin.changePass',Auth::guard('admin')->user()->id)}}" class="btn btn-primary text-white"> Update Password</a>
                        
          @endif
        </div>
      </div>
        </div>
      </div>
    </nav>
  </header>