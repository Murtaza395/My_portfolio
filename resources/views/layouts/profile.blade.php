<div class="d-flex ms-3">
    @if (Auth::check())
    <div class="card border border-dark" style="width: 18rem; margin-top:20px;">
        <img src="{{ asset('uploads/profile/thumb/'.Auth::user()->profile_pic )}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{Auth::user()->name}}</h5>
            <p class="card-text">{{Auth::user()->email}}</p>
            <a href="{{route('user.changeDP',Auth::user()->id)}}" class="btn btn-primary">Change Profile Pic</a>
            <a href="{{route('user.changePass',Auth::user()->id)}}" class="btn btn-primary mt-3">Change Password</a>
        </div>
    </div>
    @endif