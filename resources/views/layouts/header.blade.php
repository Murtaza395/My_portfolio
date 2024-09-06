<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{route('user.dashboard')}}">My Portfolio</a>
        <button class="navbar-toggler text-white bg-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="{{route('user.dashboard')}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Projects
                    </a>
                    <ul class="dropdown-menu">
                        @if (Auth::check())
                        <li><a class="btn btn-primary form-control" href="{{route('user.allProjects',Auth::user()->id)}}">All Projects</a></li>                         
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <a class="btn btn-primary form-control" href="{{route('user.viewprojects',Auth::user()->id)}}">My Projects</a></li>                   
                        @endif                         
                    </ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        @if (Auth::check())
                        <li><a class="btn btn-primary form-control" href="{{route('user.completeProfile',Auth::user()->id)}}">Complete Your Profile</a></li>
                        <li><a class="btn btn-primary mt-2 form-control" href="{{route('user.editProfile',Auth::user()->id)}}">My Profile</a></li>                           
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="btn btn-primary form-control" href="{{route('user.logout')}}">Logout</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            @if (!Auth::check())
            <a href="{{route('user.login')}}" class="btn btn-outline-primary ms-2">Login</a>
            <a href="{{route('user.register')}}" class="btn btn-outline-primary ms-2">Register</a>             
            @endif
            @if(Auth::check() && Auth::user()->usertype==="admin")
            <a class="btn btn-outline-primary ms-2" href="{{route('admin.dashboard')}}">Admin Dashboard</a> 
            @endif  
        </div>
    </div>
</nav>