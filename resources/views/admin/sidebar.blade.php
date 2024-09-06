<nav id="sidebar" class="sucess">
    <!-- Sidebar Header-->
    <div class="sidebar-header text-center align-items-center">
        @if(Auth::guard('admin')->check()) 
        <div><img src="{{ asset('/uploads/profile/'.Auth::guard('admin')->user()->profile_pic) }}" width="200" class="b"></div>
        <div class="title">
            <h1 class="h5 text-white">{{ Auth::guard('admin')->user()->name }}</h1>
        </div>
    </div>
   <span class="heading text-white">{{ Auth::guard('admin')->user()->usertype }}</span>
   @endif
    <ul class="list-unstyled grey">
        <li><a href="{{route('admin.dashboard')}}" class="text-white"> <i class="icon-home"></i>Home </a></li>
        @foreach ($pro as $pros)
        <li><a href="{{route('admin.allProjects',$pros->id)}}" class= "text-white"><i class="icon-windows"></i> Projects</a></li>
        @endforeach
        <li><a href="{{route('admin.totalUsers')}}" class="text-white"><i class="icon-user"></i>Users</a></li>
</nav>
